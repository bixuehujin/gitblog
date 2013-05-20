<?php
/**
 * Post AR class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

class Post extends CActiveRecord {

	const STATUS_NORMAL     = 0;
	const STATUS_DELETED    = 1;
	const STATUS_UNVISIABLE = 2; // only author can view.
	
	/**
	 * Tags attached to current post.
	 * @var Tag[]
	 */
	private $tags;
	
	/**
	 * @return Post
	 */
	public static function model($className = __CLASS__) {
		return parent::model($className);
	}
	
	public function tableName() {
		return 'post';
	}
	
	public function relations() {
		return array(
			'revision'=>array(self::HAS_ONE, 'PostRevision', array('revision_id'=>'revision_id')),
			'author'=>array(self::HAS_ONE, 'User', array('uid'=>'uid')),
		);
	}
	
	public function getCategory() {
		return Category::load($this->cid);
	}
	
	
	/**
	 * Fetch posts by category id.
	 * @param integer $id
	 * @param array $options specify extra options.
	 * <ul>
	 * <li>
	 * order: 
	 * </li>
	 * <li>
	 * limit: how many records do you want fetch.
	 * </li>
	 * <li>
	 * page:
	 * </li>
	 * </ul>
	 * @return array of Post object or empty array if no records found.
	 */
	public function getByCategoryId($id = 0, $options = array()) {
		$options += array(
			'order' => 'post_id DESC',
			'limit' => 10,		
		);
		$criteria = new CDbCriteria();
		$criteria->limit = $options['limit'];
		$criteria->order = $options['order'];
		
		if($id != 0) {
			$ids = Category::model()->getSubCategoryIDs($id);
			if (empty($ids)) {
				$ids = array($id);
			}
			$criteria->addInCondition('category_id', $ids);
		}
		return $this->findAll($criteria);
	}
	
	/**
	 * @param string $path
	 * @return object on success, otherwise null
	 */
	public function findByPath($path) {
		return $this->find("path='$path'");
	}
	
	/**
	 * fetch posts by tag_id.
	 * @param integer $id 
	 * @return array
	 */
	public function getByTagId($id = 0) {
		if($id == 0) 
			return array();
		
		$postTagModel = PostTag::model();
		$postIds = $postTagModel->getPostIds($id);
		
		if(empty($postIds)) 
			return array();
		
		$criteria = new CDbCriteria();
		$criteria->addInCondition('post_id', $postIds);
		return $this->findAll($criteria);
	}
	
	
	public function getFormattedDate() {
		date_default_timezone_set('Asia/Shanghai');
		return date('Y年m月d日 H:i', $this->created);
	}
	
	/**
	 * update tags relation to this post
	 * 
	 * @param mixed $tags
	 */
	public function updateTags($tags) {
		if (is_string($tags)) {
			$tags = explode(',', $tags);
			foreach($tags as &$tag) {
				$tag = trim($tag);
			}
		}
		if (empty($tags)) {
			return false;
		}
		$tagsInfo = Tag::getTagsInfo($tags);
		$newTags = Tag::getNewTags($tagsInfo);
		$insertTags = Tag::addTagsBatch($newTags);
		$tags = $insertTags + $tagsInfo;
		
		$shouldIds = array();
		foreach($tags as $tag) {
			if(isset($tag['id'])) {
				$shouldIds[] = $tag['id'];
			}
		}
		
		$ids = PostTag::getTagIds($this->post_id);
		
		$addIds = array_diff($shouldIds, $ids);
		$deleteIds = array_diff($ids, $shouldIds);
		
		PostTag::removeTags($this->post_id, $deleteIds);
		PostTag::addTags($this->post_id, $addIds);
		return true;
	}
	
	/**
	 * get post abstract according to system settings.
	 * 
	 * @return string
	 */
	public function getAbstract() {
		if (!empty($this->summary)) {
			return $this->summary;
		}
		$ret = '';
		if(Yii::app()->systemSettings->get('auto_abstract_generation')) {
			$len = Yii::app()->systemSettings->get('post_abstract_len') ?: 200;
			if (mb_strlen($this->content->body, 'utf-8') <= $len) {
				$ret = $this->content->body;
			}else {
				$ret = mb_substr($this->content->body, 0, $len, 'utf-8') . '... ...';
			}
		}
		return $ret;
	}
	
	/**
	 * @return Tag[]
	 */
	public function getAttachedTags() {
		if ($this->tags === null) {
			$this->tags = TermEntity::getAttachedTerms($this->pid, 'post');
		}
		return $this->tags;
	}
	
	/**
	 * Apply a category to the current post.
	 * 
	 * @param string $catName
	 */
	public function applyCategory($catName) {
		$catgory = Category::loadByName($catName);
		if ($catgory && $this->cid != $catgory->cid) {
			$this->cid = $catgory->cid;
			$this->save(false, array('cid'));
		}
	}
	
	/**
	 * Apply a set of tags to the current post.
	 * 
	 * @param array $tagNames
	 */
	public function applyTags($tagNames) {
		$otags = $this->getAttachedTags();
		$otags = Utils::arrayColumns($otags, null, 'name');
		$otagNames = array_keys($otags);
		
		$deletedTags = array_diff($otagNames, $tagNames);
		$addedTags = array_diff($tagNames, $otagNames);
		
		$ntags = $otags;
		
		foreach ($deletedTags as $tagName) {
			$otags[$tagName]->unattach($this->pid, 'post');
			unset($ntags[$tagName]);
		}
		foreach ($addedTags as $tagName) {
			$tag = Tag::loadByName($tagName, true);
			if ($tag) {
				$ntags[$tagName] = $tag;
			}
		}
		$this->tags = $ntags;
	}
	
	
	/**
	 * check if specified post is exsit.
	 * @param integer $postId
	 */
	public static function checkExist($postId) {
		return (bool)self::model()->find('post_id=' . $postId);
	}
	
	/**
	 * Fetch a data provider of Post by category id.
	 * 
	 * @param integer $catid
	 * @param integer $pageSize
	 * @return CActiveDataProvider
	 */
	public static function fetchProviderByCategoryId($catid = 0, $pageSize = 10) {
		$criteria = new CDbCriteria();
		if ($catid) {
			$criteria->addInCondition('cid', array($catid));
		}
		$criteria->order = 'pid DESC';
		return new CActiveDataProvider(__CLASS__, array(
			'criteria' => $criteria,
			'pagination' => array(
				'pageVar' => 'p',
				'pageSize' => $pageSize,
			)
		));
	}
	
	/**
	 * Fetch a data provider of Post by author.
	 * 
	 * @param integer $uid
	 * @param integer $pageSize
	 * @return CActiveDataProvider
	 */
	public static function fetchProviderByAuthor($uid, $pageSize = 10) {
		$criteria = new CDbCriteria();
		$criteria->addColumnCondition(array(
			'author' => $uid,
		));
		$criteria->order = 'pid DESC';
		return new CActiveDataProvider(__CLASS__, array(
			'criteria' => $criteria,
			'pagination' => array(
				'pageVar' => 'p',
				'pageSize' => $pageSize,
			),
		));
	}
	
	
	/**
	 * Fetch a data provider of Post by tagId.
	 *
	 * @param integer $tagId
	 * @param integer $pageSize
	 * @return CActiveDataProvider
	 */
	public static function fetchProviderByTag($tagId, $pageSize = 10) {
		
	}
}
