<?php
/**
 * AccountInfoForm class file.
 * 
 * @author  Jin Hu <bixuehujin@gmail.com>
 * @since   2012-04-10
 */

class AccountInfoForm extends CFormModel {
	
	public $username;
	public $email;
	public $truename;
	public $gender;
	public $github;
	public $weibo;
	/**
	 * @var User
	 */
	private $_user;

	/**
	 * Constructor.
	 * 
	 * @param string  $scenario
	 * @param User    $user
	 */
	public function __construct($scenario = null, $user = null) {
		if (!$user instanceof User) {
			throw new InvalidArgumentException("The argument \$user should be instance of User.");
		}
		$this->_user = $user;
		$this->setAttributes($this->_user->getAttributes(), false);
	}
	
	public function rules() {
		return array(
			array('username,email,gender', 'required'),
			array('truename,github,weibo', 'safe'),
		);
	}
	
	public function attributeLabels() {
		return array(
			'username' => Yii::t('view', 'Username'),
			'email' => Yii::t('view', 'Email'),
			'truename' => Yii::t('view', 'True Name'),
			'gender' => Yii::t('view', 'Gender'),
			'github' => Yii::t('view', 'GitHub Account'),
			'weibo' => Yii::t('view', 'Twitter Account')
		);
	}
	
	/**
	 * Save the account info.
	 * 
	 * @return boolean
	 */
	public function save() {
		Yii::app()->console->addModel($this);
		if (!$this->validate()) {
			return false;
		}
		$this->_user->setAttributes($this->getAttributes(), false);
		if (!$this->_user->save(false)) {
			Yii::app()->console->addError(Yii::t('view', 'Failed to save configurations'));
			return false;
		}
		Yii::app()->console->addSuccess(Yii::t('view', 'Save configuration success'));
		return true;
	}
}
