<?php
class PostTag extends CActiveRecord {
	
	static public function model($className = __CLASS__) {
		return parent::model($className);
	}
	
	public function tableName() {
		return 'post_tag';
	}
	
	
	public function relations() {
		return array(
				'tag'=>array(self::HAS_ONE, 'Tag', array('tag_id'=>'tag_id'))
		);
	}
	
	/**
	 * load postIds from database for specified tagId.
	 * @param integer $tagId
	 * @return array
	 */
	public function getPostIds($tagId) {
		if($tagId == 0) return array();
		$res = $this->findAll('tag_id=' . $tagId);
		$ret = array();
		foreach($res as $re) {
			$ret[] = $re->post_id;
		}
		return $ret;
	}
	
	
	/**
	 * Return tagIds by post_id
	 * @param int $post_id
	 * @return array
	 */
	static public function getTagIds($post_id) {
		$tags = self::model()->findAll(array(
			'condition'=>'post_id=' . $post_id,
		));
		
		$ids = array();
		foreach($tags as $tag) {
			$ids[] = $tag->tag_id;
		}
		return $ids;
	}
	
	/**
	 * Return tagNames by post_id
	 * 
	 * @param int $post_id
	 * @return array
	 */
	static public function getTagNames($postId) {
		$tags = self::model()->findAll(array(
			'condition'=>"post_id=$postId",
			'with'=>array('tag'),
		));
		$names = array();
		foreach($tags as $tag) {
			$names[] = $tag->tag->name;
		}
		return $names;
	}

	/**
	 * remove post tag relation
	 * 
	 * @param int $post_id
	 * @param array $tagIds
	 * @return int
	 */
	static public function removeTags($post_id, $tagIds) {
		$criteria = new CDbCriteria();
		$criteria->condition = 'post_id=' . $post_id;
		$criteria->addInCondition('tag_id', $tagIds);
		return self::model()->deleteAll($criteria);
	}
	
	/**
	 * add post tag relation
	 * 
	 * @param int $post_id
	 * @param array $tagIds
	 * @return int
	 */
	static public function addTags($post_id, $tagIds) {
		$count = 0;
		foreach($tagIds as $tagId) {
			$model = new PostTag();
			$model->post_id = $post_id;
			$model->tag_id = $tagId;
			$model->save(false) && $count ++;
		}
		return $count;
	}
}