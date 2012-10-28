<?php
class SystemSettingsModel extends CActiveRecord {
	
	public function tableName() {
		return 'system';
	}
	
	static public function model($className = __CLASS__) {
		return parent::model($className);
	}
	
	protected function beforeSave() {
		$this->value = json_encode($this->value);
		return true;
	}
	
	protected function afterFind() {
		$this->value = json_decode($this->value);
	}
	
}