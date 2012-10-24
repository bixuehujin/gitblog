<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	
	public $id;
	public $name;
	public $pwd;
	
	
	public function __construct($name, $pwd) {
		$this->name = $name;
		$this->pwd = $pwd;
	}
	
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$userModel = User::model();
		$user = $userModel->getByName($this->name);
		if(!$user) {
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		}else if($user->pwd != md5($this->pwd)) {
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		}else {
			$this->errorCode = self::ERROR_NONE;
			$this->id = $user->uid;
		}
		return !$this->errorCode;
	}
	
	
	public function getId() {
		return $this->id;
	}
	
	
	public function getName() {
		return $this->name;
	}
}