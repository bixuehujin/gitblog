<?php
/**
 * SystemGitForm class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

class SystemGitForm extends CFormModel {
	
	public $git_base_path;
	
	/**
	 * @var Settings
	 */
	private $settings;
	
	public function init() {
		$this->settings = Yii::app()->getComponent('settings');
		foreach ($this->getAttributes() as $key => $name) {
			$this->$key = $this->settings->get($key);
		}
	}
	
	public function rules() {
		return array(
			array('git_base_path', 'required')
		);
	}
	
	public function attributeLabels() {
		return array(
			'git_base_path' => Yii::t('admin', 'Git base path'),
		);
	}
	
	public function save() {
		if (!$this->validate()) {
			Yii::app()->console->addModel($this);
			return false;
		}
		
		foreach ($this->getAttributes() as $key => $value) {
			$this->settings->set($key, $value);
		}
		Yii::app()->console->addSuccess(Yii::t('admin', 'Save configuration success'));
		return true;
	}
}
