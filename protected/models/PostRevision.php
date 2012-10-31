<?php
class PostRevision extends CActiveRecord {
	
	static public function model($className = __CLASS__) {
		return parent::model($className);
	}
	
	public function tableName() {
		return 'post_revision';
	}
	
	public function afterFind() {
		$this->reference = unserialize($this->reference);
	}
}