<?php
class PostTag extends CActiveRecord {
	
	static public function model($className = __CLASS__) {
		return parent::model($className);
	}
	
	public function tableNmae() {
		return 'post_tag';
	}
	
	
}