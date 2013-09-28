<?php
/**
 * RegionalForm class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

class RegionalForm extends CFormModel {
	
	public $default_timezone;
	public $default_country;
	
	public function init() {
		foreach ($this->attributeNames() as $name) {
			$this->$name = Yii::app()->settings->get('site_' . $name);
		}
	}
	
	public function rules() {
		return array(
			array('default_timezone,default_country', 'safe')
		);
	}
	
	public function attributeLabels() {
		return array(
			'default_timezone' => Yii::t('admin', 'Default time zone'),
			'default_country' => Yii::t('admin', 'Default country'),
		);
	}
	
	public function save() {
		if (!$this->validate()) {
			Yii::app()->console->addModel($this);
			return false;
		}
		$settings = Yii::app()->settings;
		foreach ($this->attributeNames() as $name) {
			$settings->set('site_' . $name, $this->$name);
		}
		Yii::app()->console->addSuccess(Yii::t('admin', 'Save configuration success'));
		return true;
	}
	
	public function getAllCountries() {
		$values = array(
			'China',
		);
		return array_combine($values, $values);
	}
	
	public function getAllTimezones() {
		$tzs = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
		return array_combine($tzs, $tzs);
	}
}
