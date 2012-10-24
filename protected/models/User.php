<?php
class User extends CActiveRecord {
	
	static public function model($className = __CLASS__) {
		return parent::model($className);
	}
	
	
	public function tableName() {
		return 'user';
	}
	
	
	public function getByName($name) {
		return $this->find("name='$name'");
	}
	
	
	public function getById($id) {
		return $this->findByPk($id);
	}
	
	
	
}