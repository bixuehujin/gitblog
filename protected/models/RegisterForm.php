<?php
/**
 * RegisterForm class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

class RegisterForm extends CFormModel {
	
	public $username;
	public $email;
	public $password;
	
	public function attributeLabels() {
		return array(
			'username' => '用户名',
			'email' => '电子邮件',
			'password' => '密码',
		);
	}

	public function rules() {
		return array(
			array('username,email,password', 'required'),
			array('username', 'match', 'pattern' => '/^[\w-]{5,16}$/', 'message' => '用户名 应为5-16位字母、数字组合'),
			array('email', 'email'),
		);
	}
	
	public function validate($attributes = null, $clearErrors = true) {
		if (!parent::validate($attributes, $clearErrors)) {
			return false;
		}
		if (User::isNameTaken($this->username)) {
			$this->addError('username', '该用户已被注册');
		}
		if (User::isEmailTaken($this->email)) {
			$this->addError('email', '该邮箱已被占用');
		}
		return !$this->hasErrors();
	}
	
	public function save() {
		if (!$this->validate()) {
			Yii::app()->console->addModel($this);
			return false;
		}
		if (User::create($this->username, $this->email, $this->password)) {
			Yii::app()->console->addSuccess('用户注册成功');
			return true;
		}
		Yii::app()->console->addError('用户注册失败');
		return false;
	}
}
