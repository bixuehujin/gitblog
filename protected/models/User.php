<?php
/**
 * User model class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

class User extends CActiveRecord {
	
	/**
	 * @param string $className
	 * @return User
	 */
	static public function model($className = __CLASS__) {
		return parent::model($className);
	}
	
	
	public function tableName() {
		return 'user';
	}
	
	
	public function getByName($name) {
		return $this->findByAttributes(array('username'=>$name));
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
	
	/**
	 * check if specified user is exsit.
	 * 
	 * @param integer $uid
	 */
	static public function checkExist($uid) {
		return (bool)self::model()->find('uid=' . $uid);
	}
	
	/**
	 * checking if given username is taken by others.
	 * 
	 * @param string $name
	 * @param mixed $uid the uid to check, used for changed user information, default to null. 
	 * @return boolean
	 */
	public function isNameTaken($name, $uid = null) {
		$user = $this->findByAttributes(array('username'=>$name));
		if ($uid == null) {
			return (bool) $user;
		}
		if (!$user) return false;

		return ($user->uid != $uid); 
	}
	
	/**
	 * checking if given email is taken by others.
	 *
	 * @param string $email
	 * @param mixed $uid the uid to check, used for changed user address, default to null.
	 * @return boolean
	 */
	public function isEmailTaken($email, $uid = null) {
		$user = $this->findByAttributes(array('email'=>$email));
		if ($uid == null) {
			return (bool) $user;
		}
		if (!$user) return false;
		
		return ($user->uid != $uid);
	}
	
}
