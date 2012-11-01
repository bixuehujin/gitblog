<?php
class ContentSettingForm extends CFormModel {
	
	public $github;
	public $repository;
	public $branch;
	
	private $_model;
	
	public function init() {
		$model = UserSetting::model();
		$model->uid = Yii::app()->user->id;
		$setting = $model->findByPk($model->uid);
		
		foreach ($this->attributeNames() as $name) {
			$this->$name = $setting->$name;
		}
		$this->_model = $model;
	}
	
	public function attributeNames() {
		return array(
			'github',
			'repository',
			'branch'
		);
	}
	
	public function attributeLabels() {
		return array(
			'github' => 'GitHub帐号',
			'repository' => '仓库名称',
			'branch' => '分支名称'
		);
	}
	
	public function rules() {
		return array(
			array('github', 'required'),
			array('repository', 'required'),
			array('branch', 'required')
		);
	}
	
	/**
	 * validate form attributes and save record.
	 * 
	 * @return boolean
	 */
	public function save() {
		if(!$this->validate()) {
			return false;
		}

		$userSetting = $this->_model;
		$userSetting->uid = Yii::app()->user->id;
		
		foreach ($this->attributes as $key => $value) {
			$userSetting->$key = $value;
		}
		
		return $userSetting->update($this->attributeNames());
	}
	
} 