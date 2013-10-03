<?php
class SystemWebsiteForm extends CFormModel {
	
	private $_settings;
	
	public $site_name;
	public $site_desp;
	public $site_slogan;
	public $site_email;
	public $site_register_on;
	
	public function init() {
		$this->_settings = Yii::app()->systemSettings;
		foreach($this->attributeNames() as $name) {
			$this->$name = $this->_settings->get($name);
		}
		$this->site_register_on = $this->_settings->get('site_register_on', 1);
	}
	
	
	public function rules() {
		return array(
			array('site_name', 'required'),
			array('site_desp', 'required'),
			array('site_slogan', 'default'),
			array('site_email', 'email', 'allowEmpty' => false, 'message'=>Yii::t('admin', 'Email address is not valid')),
			array('site_register_on', 'type', 'type' => 'integer'),
		);
	}
	
	
	public function attributeLabels() {
		return array(
			'site_name' => Yii::t('admin', 'Site name'),
			'site_desp' => Yii::t('admin', 'Site description'),
			'site_slogan' => Yii::t('admin', 'Slogan'),
			'site_email' => Yii::t('admin', 'Email address'),
			'site_register_on' => Yii::t('admin', 'Allow registration'),
		);
	}
	
	
	public function save() {
		if(!$this->validate()) {
			return false;
		}
		foreach($this->attributes as $key => $value) {
			$this->_settings->set($key, $value);
		}
		return true;
	}
}
