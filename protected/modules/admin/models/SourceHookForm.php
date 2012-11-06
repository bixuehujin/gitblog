<?php
/**
 * SourceHookForm class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

class SourceHookForm extends CFormModel {
	
	public $url;
	
	private $_settings;
	
	public function init() {
		$model = UserSetting::model();
		$this->_settings = $model->find('uid=' . Yii::app()->user->id);
		$this->url = $this->getHookUrl();
	}
	
	public function getHookUrl() {
		$url = '';
		if($this->_settings) {
			//Helper::print_r(Yii::app()->request->getHostInfo());
			$url .= Yii::app()->request->getHostInfo()
				 . '?r=push/commit&token=' . $this->_settings->token;
		}
		//Helper::print_r($url);
		return $url;
	}
	
	public function attributeLabels() {
		return array(
			'url'=>'Hook URL'
		);
	}
	
	/**
	 * generate a new github hook url.
	 * 
	 * @return boolean
	 */
	public function generate() {
		$this->_settings->token = sha1(time() . $this->_settings->uid);
		return $this->_settings->update(array('token'));
	}
}
