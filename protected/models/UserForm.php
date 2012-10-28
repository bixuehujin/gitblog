<?php
class UserForm extends CFormModel {
	
	public $username;
	public $truename;
	public $email;
	public $weibo;
	public $github;
	public $gender;
	
	public $attributes;
	
	private $_model;
	
	public function init() {
		$uid = Yii::app()->user->id;
		$model = User::model();
		//$model->uid = $uid;
		$user = $model->findByPk($uid);
		
		$this->username = $user->username;
		$this->email = $user->email;
		$this->weibo = $user->weibo;
		$this->github = $user->github;
		$this->truename = $user->truename;
		$this->gender = $user->gender;
		
		$this->_model = $model;
	}
	
	
	public function attributeLabels() {
		return array(
			'username' => '用户名',
			'truename' => '真实名称',
			'email' => '电子邮件',
			'weibo' => '新浪微博',
			'github' => 'GitHub',
			'gender' => '性别'
		);
	}
	
	
	public function save() {
		$model = User::model();
		foreach($this->attributes as $key => $value) {
			$this->$key = $model->$key = $value;
		}
		$model->uid = Yii::app()->user->id;
		return $model->update(array_keys($this->attributeLabels()));
	}

}