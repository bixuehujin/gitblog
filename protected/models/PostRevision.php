<?php
/**
 * PostRevision AR class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

class PostRevision extends CActiveRecord {

	private $parser;
	
	/**
	 * @return PostRevision
	 */
	public static function model($className = __CLASS__) {
		return parent::model($className);
	}
	
	public function tableName() {
		return 'post_revision';
	}
	
	protected function parseContent() {
		if ($this->parser == null) {
			$parser = new PostParser();
			$parser->setBody($this->content);
			$parser->parse();
			$this->parser = $parser;
		}
		return $this->parser;
	}
	
	/**
	 * get a structured array for render post navigation.
	 *
	 * @return array array c
	 */
	public function getFormattedReference() {
		$parser = $this->parseContent();
		$items = $parser->reference;
		$this->processReference($items);
		return $items;
	}
	
	public function getFormattedContent() {
		$parser = $this->parseContent();
		return $parser->content;
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
	
	
	public function beforeSave() {
		if ($this->isNewRecord) {
			$this->created = time();
		}
		return parent::beforeSave();
	}
}
