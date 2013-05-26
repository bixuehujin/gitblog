<?php
/**
 * Post AR class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

class Post extends CActiveRecord implements Commentable{

	const STATUS_NORMAL     = 0;
	const STATUS_DELETED    = 1;
	const STATUS_UNVISIABLE = 2; // only author can view.
	
	const TYPE_ARTICLE = 0;
	const TYPE_TOPIC   = 1;
	
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
			'content'=>array(self::HAS_ONE, 'PostRevision', array('rid'=>'rid')),
		);
	}
	
	public function getAuthor() {
		return User::load($this->author);
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
	
	
	public function getFormattedCreated() {
		return date('m月d日 H:i', $this->created);
	}
	
	public function getFormattedModified() {
		return date('m月d日 H:i', $this->created);
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
		if(Yii::app()->settings->get('auto_abstract_generation')) {
			$len = Yii::app()->settings->get('post_abstract_len') ?: 200;
			if (mb_strlen($this->content->formattedContent, 'utf-8') <= $len) {
				$ret = $this->content->formattedContent;
			}else {
				$ret = mb_substr($this->content->formattedContent, 0, $len, 'utf-8') . '... ...';
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
	 * @param string|array $tagNames
	 */
	public function applyTags($tagNames) {
		if (is_string($tagNames)) {
			$tagNames = explode(',', $tagNames);
		}
		foreach ($tagNames as &$tagName) {
			$tagName = trim($tagName);
		}
		unset($tagName);
		
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
				$tag->attachTo($this->pid, 'post');
				$ntags[$tagName] = $tag;
			}
		}
		$this->tags = $ntags;
	}
	
	public function beforeSave() {
		if ($this->getIsNewRecord()) {
			$this->created = time();
		}
		$this->modified = time();
		return parent::beforeSave();
	}
	
	/**
	 * Get the comment DataProvider for current post.
	 * 
	 * @param integer $pageSize
	 * @return CActiveDataProvider
	 */
	public function getCommentProvider($pageSize = 10) {
		return Comment::fetchProviderByOwner($this, $pageSize);
	}
	
	/**
	 * Get all user contributed to the post.
	 * 
	 * @return User[]
	 */
	public function getCommitters() {
		$criteria = new CDbCriteria();
		$criteria->addColumnCondition(array('post_id' => $this->pid));
		$criteria->distinct = true;
		$criteria->select = array('creator');
		$list = PostRevision::model()->findAll($criteria);
		$users = array();
		foreach ($list as $item) {
			if ($user = User::load($item->creator)) {
				$users[] = $user;
			}
		}
		return $users;
	}
	
	/**
	 * Update the visitors counter of this post.
	 */
	public function updateVisitors() {
		return (boolean)$this->updateCounters(array('visitors' => 1), 'pid=' . $this->pid);
	}
	
	/**
	 * Get all revison of this post.
	 * 
	 * @return PostRevision[]
	 */
	public function getRevisions() {
		return PostRevision::fetchAllRevisions($this->pid);
	}
	
	/**
	 * Load a post by its pid.
	 * 
	 * @param integer $pid
	 * @return Post
	 */
	public static function load($pid) {
		return self::model()->findByPk($pid);
	}
	
	/**
	 * Load a post by its git path.
	 * 
	 * @param string $path
	 * @return Post
	 */
	public static function loadByPath($path) {
		return self::model()->findByAttributes(array('path' => $path));
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
	 * @param integer $postType Post::TYPE_ARTICLE or Post::TYPE_TOPIC, null for all types.
	 * @param integer $pageSize
	 * @return CActiveDataProvider
	 */
	public static function fetchProviderByCategoryId($catid = 0, $postType = null, $pageSize = 10) {
		$criteria = new CDbCriteria();
		if ($catid) {
			$ids = TermHierarchy::fetchChildren($catid);
			$ids[] = $catid;
			$criteria->addInCondition('cid', $ids);
		}
		if ($postType !== null) {
			$criteria->addColumnCondition(array('type' => $postType));
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
		$criteria = new CDbCriteria();
		$criteria->join = 'join term_entity on pid=entity_id and tid=' . $tagId;
		$criteria->order = 'modified DESC';
		return new CActiveDataProvider(__CLASS__, array(
			'criteria' => $criteria,
			'pagination' => array(
				'pageVar' => 'p',
				'pageSize' => $pageSize,
			)
		));
	}
	
	public function getOwnerId() {
		return $this->pid;
	}
	
	public function getOwnerType() {
		return 'post';
	}
	
	public function getCommentCount() {
		return null;
	}
	
	public function updateCommentCounter($count) {
	}
}
