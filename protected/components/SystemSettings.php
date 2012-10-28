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
		
		if(array_key_exists($key, $this->settings) && $value === $this->settings[$key]) {
			return true;
		}
		
		$model = SystemSettingsModel::model();
		$model->name = $key;
		$model->value = $value;
		if (!array_key_exists($key, $this->settings)) {
			$model->isNewRecord = true;
			$model->save(false);
		}else {
			$model->update();
		}
		
		$this->settings[$key] = $value;
		
		return true;
	}
}