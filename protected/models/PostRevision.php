<?php
/**
 * PostRevision AR class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

class PostRevision extends CActiveRecord {

	/**
	 * @return PostRevision
	 */
	public static function model($className = __CLASS__) {
		return parent::model($className);
	}
	
	public function tableName() {
		return 'post_revision';
	}
	
	
	public function init() {
		$this->attachEventHandler('onAfterFind', array($this, 'handleOnAfterFind'));
		$this->attachEventHandler('onBeforeSave', array($this, 'handleOnBeforeSave'));
	}
	
	/**
	 * event handler for OnAfterFind event.
	 * 
	 * @param CModelEvent $event
	 */
	public function handleOnAfterFind($event) {
		$this->reference = unserialize($this->reference);
	}

	/**
	 * event handler for OnBeforeSave event.
	 * 
	 * @param CModelEvent $event
	 */
	public function handleOnBeforeSave($event) {
		$this->reference = serialize($this->reference);
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
