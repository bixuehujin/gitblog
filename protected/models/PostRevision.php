<?php
class PostRevision extends CActiveRecord {
	
	static public function model($className = __CLASS__) {
		return parent::model($className);
	}
	
	public function tableName() {
		return 'post_revision';
	}
	
	public function afterFind() {
		$this->reference = unserialize($this->reference);
		return parent::afterFind();
	}
	
	public function beforeSave() {
		$this->reference = serialize($this->reference);
		return parent::beforeSave();
	}
	
	public function findByShaAndPostID($sha, $post_id) {
		return $this->find("sha='$sha' and post_id=$post_id");
	}
	
	/**
	 * get a structured array for render post navigation.
	 *
	 * @return array array c
	 */
	public function getFormattedReference() {
		$items = $this->reference;
		if (!is_array($items)) {
			return array();
		}
		$this->processReference($items);
		return $items;
	}
	
	
	protected function processReference(&$items) {
		static $i = 0;
		foreach($items as &$item) {
			$item['label'] = $item['title'];
			$item['url'] = '#id-' . $i ++;
			if(isset($item['items'])) {
				$this->processReference($item['items']);
			}
		}
	}
}
