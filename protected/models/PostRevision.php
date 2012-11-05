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
		return parent::afterFind();
	}
	
	public function beforeSave() {
		$this->reference = serialize($this->reference);
		return parent::beforeSave();
	}
	
	public function findByShaAndPostID($sha, $post_id) {
		return $this->find("sha='$sha' and post_id=$post_id");
	}
}