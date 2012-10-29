<?php
class ContentSettingForm extends CFormModel {
	
	public $github;
	public $repository;
	
	public $attributes;
	private $_model;
	
	public function init() {
		$model = UserSetting::model();
		$model->uid = Yii::app()->user->id;
		$setting = $model->findByPk($model->uid);
		
		$this->github = $setting->github;
		$this->repository = $setting->repository;
		
		$this->_model = $model;
	}
	
	public function attributeNames() {
		return array(
			'github',
			'repository'
		);
	}
	
	public function attributeLabels() {
		return array(
			'github' => 'GitHub帐号',
			'repository' => '仓库名称'
		);
	}
	
	
	public function save() {
		
		$userSetting = $this->_model;
		$userSetting->uid = Yii::app()->user->id;
		foreach ($this->attributes as $name => $value) {
			$this->$name = $userSetting->$name = $value;
		}
		
		return $userSetting->update($this->attributeNames());
	}
	
} 