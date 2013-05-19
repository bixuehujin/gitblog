<?php
/**
 * GitSettingForm class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

class GitSettingForm extends CFormModel {
	
	public $branch;
	public $repository;
	
	private $_model;
	
	public function init() {
		$model = UserSetting::model();
		
		foreach ($this->attributeNames() as $name) {
			$this->$name = $model->get($name);
		}
		$this->_model = $model;
	}
	
	public function attributeLabels() {
		return array(
			'branch' => '分支名称',
			'repository' => '仓库名称',
		);
	}
	
	public function rules() {
		return array(
			array('repository,branch', 'required'),
		);
	}
	
	/**
	 * validate form attributes and save record.
	 * 
	 * @return boolean
	 */
	public function save() {
		if(!$this->validate()) {
			Yii::app()->console->addModel($this);
			return false;
		}
		
		foreach ($this->getAttributes() as $key => $value) {
			$this->_model->set($key, $value);
		}
		Yii::app()->console->addSuccess('保存配置成功');
		return true;
	}
}
