<?php
/**
 * PostStatus class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

/**
 * @property Post $post
 */
class PostStatus extends CWidget {
	
	private $_post;
	
	public $countVisitors = true;
	
	public function setPost(Post $post) {
		$this->_post = $post;
		return $this;
	}
	
	public function getPost() {
		if ($this->_post == null) {
			throw new CException("The 'post' param is null.");
		}
		return $this->_post;
	}
	
	public function getLastCommitter() {
		return User::load($this->getPost()->committer);
	}
	
	public function getLastCommitDate() {
		return $this->getPost()->getFormattedModified();
	}
	
	public function getRevisionCount() {
	}
	
	
	public function run() {
		if ($this->countVisitors) {
			$url = Yii::app()->createUrl('post/visitors', array('id' => $this->getPost()->pid));
			Yii::app()->clientScript->registerScript('post_status', "$.get('$url')", CClientScript::POS_READY);
		}
		$this->renderFile($this->getViewFile('post_status'));
	}
}
