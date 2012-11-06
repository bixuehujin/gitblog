<?php
class Post extends CActiveRecord {
	
	static public function model($className = __CLASS__) {
		return parent::model($className);
	}
	
	public function tableName() {
		return 'post';
	}
	
	public function relations() {
		return array(
			'content'=>array(self::HAS_ONE, 'PostRevision', array('revision_id'=>'revision_id')),
			'category'=>array(self::HAS_ONE, 'Category', array('category_id'=>'category_id')),
			'user'=>array(self::HAS_ONE, 'User', array('uid'=>'uid')),
			'tags'=>array(self::HAS_MANY, 'PostTag', array('post_id'=>'post_id')),
		);
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
		return date('Y年m月d日 H:i', $this->created);
	}
}
