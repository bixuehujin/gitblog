<?php
/**
 * PostCommitter class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

/**
 * 
 * @property Post $post
 */
class PostCommitter extends CWidget {
	
	private $_committers;
	
	public function setCommitters(array $committers) {
		$this->_committers = $committers;
		return $this;
	}
	
	public function getCommitters() {
		if ($this->_committers == null) {
			throw new CException("The 'committers' param is null.");
		}
		return $this->_committers;
	}
	
	public function run() {
		$this->renderFile($this->getViewFile('post_committer'), array());
	}
	
}
