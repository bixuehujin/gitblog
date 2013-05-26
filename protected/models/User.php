<?php
/**
 * User AR class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 * @since  2012-10-10
 */

class User extends CActiveRecord implements Commentable{
	
	/**
	 * Cahces of loaded user objects, indexed by uid.
	 * 
	 * @var User[]
	 */
	private static $cached      = array();
	/**
	 * Cahces of loaded user objects, indexed by username.
	 *
	 * @var User[]
	 */
	private static $cachedName  = array();
	/**
	 * Cahces of loaded user objects, indexed by email.
	 *
	 * @var User[]
	 */
	private static $cachedEmail = array();
	
	private $_avatarImage;
	
	/**
	 * @return User
	 */
	public static function model($className = __CLASS__) {
		return parent::model($className);
	}
	
	public function tableName() {
		return 'user';
	}
	
	public function beforeSave() {
		return parent::beforeSave();
	}
	
	/**
	 * @return Image
	 */
	public function getAvatarImage() {
		if ($this->avatar && !$this->_avatarImage) {
			$this->_avatarImage = Image::load($this->avatar);
		}
		return $this->_avatarImage;
	}
	
	public function getAvatarUrl($width, $height = null) {
		$image = $this->getAvatarImage();
		if ($image) {
			return $image->getThumbURL($width, $height);
		}
		return '/misc/images/avatar-default.jpg';
	}
	
	public function getSetting($name) {
		return UserSetting::model()->get($name, $this);
	}
	
	public function setSetting($name, $value) {
		return UserSetting::model()->set($name, $value, $this);
	}
	
	/**
	 * @return boolean
	 */
	public function isSelf() {
		return $this->uid == Yii::app()->user->getId();
	}
	
	/**
	 * 
	 * @param integer $pageSize
	 * @return CActiveDataProvider
	 */
	public function getMessageProvider($pageSize = 10) {
		return Comment::fetchProviderByOwner($this, $pageSize);
	}
	
	/**
	 * Get the topic count of the user.
	 * 
	 * @return integer
	 */
	public function getTopics() {
		return Post::model()->count('author=' . $this->uid . '&type = ' . Post::TYPE_TOPIC);
	}
	
	/**
	 * Get the article count of the user.
	 *
	 * @return integer
	 */
	public function getArticles() {
		return Post::model()->count('author=' . $this->uid . '&type = ' . Post::TYPE_ARTICLE);
	}
	
	/**
	 * Load a user by its indentifier(uid, username, email) from database.
	 * 
	 * @param integer $identifier
	 * @return User
	 */
	public static function load($identifier) {
		if (is_numeric($identifier)) {
			return self::loadByUid($identifier);
		}else if (strpos($identifier, '@') !== false){
			return self::loadByEmail($identifier);
		}else {
			return self::loadByName($identifier);
		}
	}
	
	protected static function loadByUid($uid) {
		if (!isset(self::$cached[$uid])) {
			self::$cached[$uid] = self::model()->findByPk($uid);
		}
		return self::$cached[$uid];
	}
	
	protected static function loadByName($name) {
		if (!isset(self::$cachedName[$name])) {
			self::$cachedName[$name] = self::model()->findByAttributes(array('username' => $name));
		}
		return self::$cachedName[$name];
	}
	
	protected static function loadByEmail($email) {
		if (!isset(self::$cachedEmail[$email])) {
			self::$cachedEmail[$email] = self::model()->findByAttributes(array('email' => $email));
		}
		return self::$cachedEmail[$email];
	}
	
	
	public static function getName($uid) {
		$cache = StaticCache::getInstance(__CLASS__ . __FUNCTION__);
		if($username = $cache->get($uid)) {
			return $username;
		}
		$attributes = self::load($uid);
		$username = $attributes->username;
		$cache->set($uid, $username);
		return $username;
	}
	
	/**
	 * Checking if specified user is exsit.
	 * 
	 * @param integer $uid
	 */
	public static function checkExist($uid) {
		return (bool)self::model()->find('uid=' . $uid);
	}
	
	/**
	 * Checking if given username is taken by others.
	 * 
	 * @param string $name
	 * @param mixed $uid the uid to check, used for changed user information, default to null. 
	 * @return boolean
	 */
	public static function isNameTaken($name, $uid = null) {
		$user = self::model()->findByAttributes(array('username'=>$name));
		if ($uid == null) {
			return (bool) $user;
		}
		if (!$user) return false;

		return ($user->uid != $uid);
	}
	
	/**
	 * Checking if given email is taken by others.
	 *
	 * @param string $email
	 * @param mixed $uid the uid to check, used for changed user address, default to null.
	 * @return boolean
	 */
	public static function isEmailTaken($email, $uid = null) {
		$user = self::model()->findByAttributes(array('email'=>$email));
		if ($uid == null) {
			return (bool) $user;
		}
		if (!$user) return false;
		
		return ($user->uid != $uid);
	}
	
	public function getOwnerId() {
		return $this->uid;
	}
	
	public function getOwnerType() {
		return 'user';
	}
	
	public function updateCommentCounter($count) {}
	
	public function getCommentCount() {}
}
