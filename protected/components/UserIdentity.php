<?php
/**
 * UserIdentity class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 * @since 2012-10-10
 */

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity{
	
	public $id;
	public $username;
	public $password;
	
	
	public function __construct($name, $pwd) {
		$this->username = $name;
		$this->password = $pwd;
	}
	
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate(){
		$user = User::load($this->username);
		if(!$user) {
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		}else if($user->password != md5($this->password)) {
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		}else {
			$this->errorCode = self::ERROR_NONE;
			$this->id = $user->uid;
			$this->setState('user', $user);
		}
		return !$this->errorCode;
	}
	
	
	public function getId() {
		return $this->id;
	}
	
	public function getName() {
		return $this->username;
	}
}
