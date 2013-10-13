<?php
/**
 * TagShow widget class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

class TagShow extends CWidget {

	/**
	 * @var Tag
	 */
	private $_tag;
	
	public function setTag(Tag $tag) {
		$this->_tag = $tag;
		return $this;
	}
	
	public function getTag() {
		if ($this->_tag == null) {
			throw new CException("The 'tag' param is null!");
		}
		return $this->_tag;
	}
	
	public function getTagId() {
		return $this->getTag()->getAttribute('tid');
	}
	
	public function getName() {
		return $this->getTag()->getAttribute('name');
	}
	
	public function getDescription() {
		return $this->getTag()->getAttribute('description') ?: Yii::t('view', 'no description');
	}
	
	public function getAttachedCount() {
		return $this->getTag()->getNumOfAttached();
	}
	
	public function run() {
		$this->renderFile($this->getViewFile('tag_show'));
	}
}
