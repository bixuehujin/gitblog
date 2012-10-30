<?php
class User extends CActiveRecord {
	
	static public function model($className = __CLASS__) {
		return parent::model($className);
	}
	
	
	public function tableName() {
		return 'user';
	}
	
	
	public function getByName($name) {
		return $this->find("username='$name'");
	}
	
	
	public function getById($id) {
		return $this->findByPk($id);
	}
	
	
	static public function getName($uid) {
		$cache = StaticCache::getInstance(__CLASS__ . __FUNCTION__);
		if($username = $cache->get($uid)) {
			return $username;
		}
		$attributes = self::model()->find('uid=' . $uid);
		$username = $attributes->username;
		$cache->set($uid, $username);
		return $username;
	}
	
}