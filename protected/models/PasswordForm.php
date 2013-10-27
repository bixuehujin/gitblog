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
			'opassword' => Yii::t('view', 'Old Password'),
			'npassword' => Yii::t('view', 'New Password'),
			'npassword2' => Yii::t('view', 'Repeat Password'),
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
			return Yii::t('view', 'Change Password');
		}else {
			return Yii::t('view', 'Reset Password');
		}
	}
	
	public function validate($attributes = null, $clearErrors = true) {
		if (!parent::validate($attributes, $clearErrors)) {
			return false;
		}
		if ($this->scenario == self::SCENARIO_CHANGE && !$this->user->isPasswordMatch($this->opassword)) {
			$this->addError('opassword', Yii::t('view', 'The old password is not correct'));
		}
		if ($this->npassword !== $this->npassword2) {
			$this->addError('npassword', Yii::t('view', 'The new password are not match'));
		}
		return !$this->hasErrors();
	}
	
	public function change() {
		if (!$this->validate()) {
			Yii::app()->console->addModel($this);
			return false;
		}

		$this->user->password = User::encryptPassword($this->npassword);
		if ($this->user->save(false, array('password'))) {
			if ($this->scenario === self::SCENARIO_RESET) {
				$token = $this->user->getResetPasswordToken();
				$token->delete();
			}
			$message = $this->scenario === self::SCENARIO_CHANGE 
				? Yii::t('view', 'Change password success') : Yii::t('view', 'Reset password success');
			Yii::app()->console->addSuccess($message);
			return true;
		}else {
			$message = $this->scenario === self::SCENARIO_CHANGE
				? Yii::t('view', 'Change password failed') : Yii::t('view', 'Reset password failed');
			Yii::app()->console->addError($message);
			return false;
		}
	}
}
