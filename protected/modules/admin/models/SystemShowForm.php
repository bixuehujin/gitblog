<?php
class SystemShowForm extends CFormModel {
	
	public $post_page_size;
	public $comment_page_size;
	public $auto_abstract_generation;
	public $post_abstract_len;
	
	private $_settings;
	
	public function init() {
		$this->_settings = Yii::app()->settings;
		foreach ($this->attributeNames() as $name) {
			$this->$name = $this->_settings->get($name);
		}
	}
	
	public function attributeNames() {
		return array(
				'post_page_size',
				'comment_page_size',
				'auto_abstract_generation',
				'post_abstract_len',
		);
	}
	
	public function attributeLabels() {
		return array(
				'post_page_size'=>Yii::t('admin', 'Post page size'),
				'comment_page_size'=>Yii::t('admin', 'Comment page size'),
				'auto_abstract_generation'=>Yii::t('admin', 'Auto abstract generation'),
				'post_abstract_len'=>Yii::t('admin', 'Abstract length'),
		);
	}
	
	public function rules() {
		return array(
			array('post_page_size', 'type', 'type'=>'integer'),
			array('comment_page_size', 'type', 'type'=>'integer'),
			array('auto_abstract_generation', 'type', 'type'=>'integer'),
			array('post_abstract_len', 'type', 'type'=>'integer'),
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
