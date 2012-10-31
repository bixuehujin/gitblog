<?php
class SystemShowForm extends CFormModel {
	
	public $post_page_size;
	public $comment_page_size;
	
	private $_settings;
	
	public function init() {
		$this->_settings = Yii::app()->systemSettings;
		foreach ($this->attributeNames() as $name) {
			$this->$name = $this->_settings->get($name);
		}
	}
	
	public function attributeNames() {
		return array(
				'post_page_size',
				'comment_page_size'
		);
	}
	
	public function attributeLabels() {
		return array(
				'post_page_size'=>'文章分页大小',
				'comment_page_size'=>'评论分页大小'
		);
	}
	
	public function rules() {
		return array(
			array('post_page_size', 'type', 'type'=>'integer'),
			array('comment_page_size', 'type', 'type'=>'integer'),
		);
	}
	
	
	public function save() {
		
		if (!$this->validate()) {
			return false;
		}
		foreach ($this->attributes as $key=>$value) {
			$this->_settings->set($key, $value);
		}
		
		return true;
	}
}