<?php
/**
 * AccountForm class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

/**
 * represent an account form for account creation and modification.
 * 
 * @property boolean scenarioIsCreaction
 * @property boolean scenarioIsModification
 */
class AccountForm extends CFormModel {
	
	const SCENARIO_CREATION = 'creation';
	const SCENARIO_MODIFICATION = 'modification';
	
	public $uid;
	public $username;
	public $password;
	public $password2;
	public $truename;
	public $gender;
	public $email;
	public $github;
	public $weibo;
	/**
	 * @var User
	 */
	private $user;
	
	public function init() {
		$this->user = User::model();
		if ($this->scenario == '') {
			$this->scenario = self::SCENARIO_CREATION;
		}
		if (!($this->scenarioIsModification && !isset($_POST[__CLASS__]))) {
			return;			
		}

		if (isset($_GET['id']) && $_GET['id']) {
			$user = $this->user->findByPk($_GET['id']);
			if(!$user) {
				throw new RecordNotFoundException('Load user from database failed');
			}
			foreach ($this->attributeNames() as $name) {
				if($name != 'password2') {
					$this->$name = $user->$name;
				}
			}
			$this->password = '';
		}else {
			throw new InvalidRequestException("The index is not defined");
		}
		
	}
	
	public function attributeLabels() {
		return array(
			'username'=>'Account Name',
			'password'=>'Account Password',
			'password2'=>'Password Repeat',
			'truename'=>'Real Name',
			'gender'=>'Gender',
			'email'=>'Email',
			'github'=>'Github Account',
			'weibo'=>'Weibo Account',
		);
	}
	
	public function rules() {
		return array(
			array('uid', 'required', 'on'=>self::SCENARIO_MODIFICATION),
			array('username', 'required'),
			array('email', 'required'),
			array('email', 'email'),
			array('password', 'required', 'on'=>self::SCENARIO_CREATION),
			array('password2', 'required', 'on'=>self::SCENARIO_CREATION),
			array('password', 'safe', 'on'=>self::SCENARIO_MODIFICATION),
			array('password2', 'safe', 'on'=>self::SCENARIO_MODIFICATION),
			array('gender', 'safe'),
			array('github', 'safe'),
			array('weibo', 'safe'),
			array('truename', 'safe'),
		);
	}
	
	
	public function validate($attributes = null, $clearErrors = true) {
		if(!parent::validate($attributes, $clearErrors)) {
			return false;
		}

		if ($this->password != $this->password2) {
			$this->addError('password3', 'Password input does not match');
			$this->addError('password2', '');
			$this->addError('password', '');
			return false;
		}
		
		if($this->user->isNameTaken($this->username, $this->getScenarioIsCreation() ? null : $this->uid)) {
			$this->addError('Username', "username {$this->username} has been taken");
			return false;
		}
		if($this->user->isEmailTaken($this->email, $this->getScenarioIsCreation() ? null : $this->uid)) {
			$this->addError('email', "Email {$this->email} has been taken");
			return false;
		}
		
		return true;
	}
	
	/**
	 * Save or update a account record.
	 * 
	 * @return boolean
	 */
	public function save() {
		if (!$this->validate()) {
			return false;
		}
		foreach($this->attributeNames() as $name) {
			if ($name != 'password2') {
				$this->user->$name = $this->$name;
			}
		}
		
		if ($this->getScenarioIsCreation()) {
			$this->user->isNewRecord = true;
		}
		if (!$this->user->save(false, $this->getSafeAttributeNames())) {
			$this->addError('', 'Save account failed');
			return false;
		}
		$msg = $this->getScenarioIsCreation()
			? 'Add Account successfull' : 'Save Account successfull'; 
		Yii::app()->persistentMessage->addPersistentSuccess($msg);
		return true;
	}
	
	
	/**
	 * return whether the scenario is creation.
	 * 
	 * @return boolean
	 */
	public function getScenarioIsCreation() {
		return self::SCENARIO_CREATION == $this->scenario;
	}
	
	/**
	 * return whether the scenario is modification
	 * @return boolean
	 */
	public function getScenarioIsModification() {
		return self::SCENARIO_MODIFICATION == $this->scenario;
	}
	
}
