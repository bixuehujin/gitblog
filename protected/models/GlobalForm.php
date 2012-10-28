<?php
class GlobalForm extends CFormModel {
	
	
	private $_settings;
	
	public function init() {
		$this->_settings = Yii::app()->systemSettings;
		foreach($this->_settings->get() as $key => $value) {
			$this->$key = $value;
		}
	}
	
	public function attributeLabels() {
		return array(
			'site_name' => '站点名称',
			'site_desp' => '站点描述',
			'site_slogan' => '网站口号'
		);
	}
	
	
	public function __set($name, $value) {
		$this->$name = $value;
	}
	
	public function __get($name) {
		if(isset($this->$name)) {
			return $this->$name;
		}else {
			return NULL;
		}
	}
	
	
	public function save() {
		
		foreach($this->attributes as $key => $value) {
			$this->_settings->set($key, $value);
			$this->$key = $value;
		}
		return true;
	}
}