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
			'username' => '用户名',
			'email' => 'Email',
			'truename' => '真实姓名',
			'gender' => '性别',
			'github' => 'github帐号',
			'weibo' => '微博帐号',
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
			Yii::app()->console->addError('保存设置失败');
			return false;
		}
		Yii::app()->console->addSuccess('保存设置成功');
		return true;
	}
}
