<?php
class GlobalForm extends CFormModel {
	
	
	private $_settings;
	
	public $site_name;
	public $site_desp;
	public $site_slogan;
	public $site_email;
	
	public function init() {
		$this->_settings = Yii::app()->systemSettings;
		foreach($this->_settings->get() as $key => $value) {
			$this->$key = $value;
		}
	}
	
	
	public function rules() {
		return array(
				array('site_name', 'required'),
				array('site_desp', 'required'),
				array('site_slogan', 'default'),
				array('site_email', 'email', 'allowEmpty' => false, 'message'=>'邮件地址不合法'),
		);
	}
	
	
	public function attributeLabels() {
		return array(
			'site_name' => '站点名称',
			'site_desp' => '站点描述',
			'site_slogan' => '网站口号',
			'site_email' => '电子邮件地址'
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