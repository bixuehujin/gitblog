<?php
class Tag extends CActiveRecord {
	
	static public function model($className = __CLASS__) {
		return parent::model($className);
	}
	
	public function tableName() {
		return 'tag';
	}
	
	/**
	 * get tag infomation by tagId.
	 * @param integer $tagId
	 */
	static public function getTag($tagId) {
		return self::model()->find('tag_id=' . $tagId);
	}
}