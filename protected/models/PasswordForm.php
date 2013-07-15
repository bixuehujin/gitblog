<?php
/**
 * PasswordForm class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

class PasswordForm extends CFormModel {
	
	const SCENARIO_RESET  = 'reset';
	const SCENARIO_CHANGE = 'change';
	
	public $opassword;
	public $npassword;
	public $npassword2;
	
	private $user;
	
	
	public function __construct($scenario = '', User $user) {
		if (!$scenario) {
			$scenario = self::SCENARIO_CHANGE;
		}
		parent::__construct($scenario);
		$this->user = $user;
	}
	
	public function attributeLabels() {
		return array(
			'opassword' => '旧密码',
			'npassword' => '新密码',
			'npassword2' => '确认密码',
		);
	}
	
	public function rules() {
		return array(
			array('opassword', 'required', 'on' => self::SCENARIO_CHANGE),
			array('npassword,npassword2', 'required'),
		);
	}
	
	public function getButtonLabel() {
		if ($this->getScenario() === self::SCENARIO_CHANGE) {
			$prefix = '修改';
		}else {
			$prefix = '重置';
		}
		return $prefix . '密码';
	}
	
	public function validate($attributes = null, $clearErrors = true) {
		if (!parent::validate($attributes, $clearErrors)) {
			return false;
		}
		if ($this->scenario == self::SCENARIO_CHANGE && !$this->user->isPasswordMatch($this->opassword)) {
			$this->addError('opassword', '旧密码输入错误');
		}
		if ($this->npassword !== $this->npassword2) {
			$this->addError('npassword', '两次密码输入不匹配');
		}
		return !$this->hasErrors();
	}
	
	public function change() {
		if (!$this->validate()) {
			Yii::app()->console->addModel($this);
			return false;
		}
		$action = $this->scenario === self::SCENARIO_CHANGE ? '修改' : '重置';

		$this->user->password = User::encryptPassword($this->npassword);
		if ($this->user->save(false, array('password'))) {
			if ($this->scenario === self::SCENARIO_RESET) {
				$token = $this->user->getResetPasswordToken();
				$token->delete();
			}
			Yii::app()->console->addSuccess($action . '密码成功');
			return true;
		}else {
			Yii::app()->console->addError($action . '密码失败');
			return false;
		}
	}
}
