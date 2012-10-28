<?php
class SystemSettings extends CComponent {
	
	public $dbName;
	private $settings = array();
	
	public function init() {
		$model = SystemSettingsModel::model();
		$settings = $model->findAll();
		foreach ($settings as $setting) {
			$this->settings[$setting->name] = $setting->value;
		}
	}
	
	
	/**
	 * fetch system settings by key. 
	 * @param string $key the key will be get. if NULL , all settings will return.
	 * @return mixed
	 */
	public function get($key = NULL) {
		if($key == NULL) 
			return $this->settings;
		if (isset($this->settings[$key])) {
			return $this->settings[$key];
		}else {
			return NULL;
		}
	}
	
	/**
	 * 
	 * @param string $key
	 * @param mixed $value
	 * @return boolean true on success, false otherwise.
	 */
	public function set($key, $value) {
		if(!is_string($key)) 
			return false;
		
		$model = SystemSettingsModel::model();
		if (!isset($this->settings[$key])) {
			$model->isNewRecord = true;
		}
		
		$this->settings[$key] = $value;
		
		$model->name = $key;
		$model->value = $value;
		$model->save(false);
		
		return true;
	}
}