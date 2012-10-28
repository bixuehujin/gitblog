<?php
class PwdForm extends CFormModel {
	
	public $password_old;
	public $password_new;
	public $password_new2;
	
	const ERROR_AUTH_FAILED = 1;
	const ERROR_PASS_NOTMATCH = 2;
	const ERROR_NONE = 0;
	
	protected $errno;
	
	public function init() {
		
	}
	
	public function attributeLabels() {
		return array(
			'password_old' => '旧密码',
			'password_new' => '新密码',
			'password_new2' => '密码确认'		
		);
		
	}
	
	public function change($form) {
		$indentity = new UserIdentity(Yii::app()->user->name, $form['password_old']);
		if(!$indentity->authenticate()) {
			$this->errno = self::ERROR_AUTH_FAILED;
		}else if($form['password_new'] != $form['password_new2']) {
			$this->errno =  self::ERROR_PASS_NOTMATCH;
		}else {
			$user = User::model();
			$user->uid = Yii::app()->user->id;
			$user->password = md5($form['password_new']);
			$user->update(array('password'));
			$this->errno = self::ERROR_NONE;
		}
		return $this->errno == self::ERROR_NONE;
	}
	
	
	public function getErrorMsg() {
		$msgs = array(
			self::ERROR_AUTH_FAILED => '密码输入错误',
			self::ERROR_PASS_NOTMATCH => '两次密码输入不匹配',
			self::ERROR_NONE => '密码修改成功'		
		);
		return $msgs[$this->errno];
	}
}