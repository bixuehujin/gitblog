<?php
/**
 * CommitMessage widget class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */


class CommitMessage extends CWidget {
	
	private $_revision;
	
	public function setRevision(PostRevision $revision) {
		$this->_revision = $revision;
		return $this;
	}
	
	public function getRevision() {
		if ($this->_revision == null) {
			throw new CException("The 'revision' param is null!");
		}
		return $this->_revision;
	}
	
	public function getCommit() {
		return $this->getRevision()->getAttribute('commit');
	}
	
	public function run() {
		$this->renderFile($this->getViewFile('commit_message'));
	}
}
