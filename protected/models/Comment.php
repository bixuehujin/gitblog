<?php
class Comment extends CActiveRecord {
	
	static public function model($className = __CLASS__) {
		return parent::model($className);
	}
	
	public function tableName() {
		return 'comment';
	}
	
	public function rules() {
		return array(
				array('content', 'required'),
				array('post_id', 'required'),
				array('author', 'required'),
				array('email', 'required'),
				array('website', 'required'),
				array('comment_ref', 'required')
		);
	}
	
	protected function beforeSave() {
		$this->created = time();
		return parent::beforeSave();
	}
	
	protected function afterSave() {
		
		$post = Post::model();
		$post->updateCounters(array('num_comments'=>1), 'post_id=' . $this->post_id);
		return parent::afterSave();
	}
	
	protected function afterDelete() {
		$post = Post::model();
		$post->updateCounters(array('num_comments'=>-1, 'post_id' . $this->post_id));
		return parent::afterDelete();
	}
	
	public function getFormattedDate() {
		return date('Y年m月d日 H:i', $this->created);
	}
}