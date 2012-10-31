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
	
}