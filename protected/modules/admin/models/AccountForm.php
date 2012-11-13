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
	
	public $username;
	public $password;
	public $password2;
	public $truename;
	public $gender;
	public $email;
	public $github;
	public $weibo;
	
	public function init() {
		if ($this->scenario == '') {
			$this->scenario = self::SCENARIO_CREATION;
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
			array('username', 'required'),
			array('email', 'email')
		);
	}
	
	public function save() {
		
		return true;
	}
	
	public function update() {
		
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
