<?php
/**
 * Comment Model class file.
 * 
 * @author JinHu <bixuehujin@gmail.com>
 */

/**
 * Model used for present user comments.
 * 
 * @property string $formattedDate Human readable date format.
 */
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
	
	public function init() {
		$this->attachEventHandler('onBeforeSave', array($this, 'handleOnBeforeSave'));
		$this->attachEventHandler('onAfterSave', array($this, 'handleOnAfterSave'));
		$this->attachEventHandler('onAfterDelete', array($this, 'handleOnAfterDelete'));
	}
	
	/**
	 * handler for onBeforeSave event.
	 * @param CModelEvent $event
	 */
	public function handleOnBeforeSave($event) {
		$this->created = time();
	}
	
	/**
	 * handler for onAfterSave event.
	 * @param CModelEvent $event
	 */
	public function handleOnAfterSave($event) {
		Post::model()->updateCounters(array('num_comments'=>1), 'post_id=' . $this->post_id);
	}
	
	/**
	 * handler for onAfterDelete event.
	 * @param CModelEvent $event
	 */
	public function handleOnAfterDelete($event) {
		Post::model()->updateCounters(array('num_comments'=>-1, 'post_id' . $this->post_id));
	}
	
	
	public function getFormattedDate() {
		return date('Y年m月d日 H:i', $this->created);
	}
}