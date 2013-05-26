<?php
/**
 * PostRevision AR class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

class PostRevision extends CActiveRecord {

	private $parser;
	private $metaArray;
	/**
	 * @return PostRevision
	 */
	public static function model($className = __CLASS__) {
		return parent::model($className);
	}
	
	public function tableName() {
		return 'post_revision';
	}
	
	protected function getParser() {
		if ($this->parser == null) {
			$this->parser = new PostParser();
		}
		return $this->parser;
	}
	
	protected function parseContent() {
		$parser = $this->getParser();
		$parser->setBody($this->content);
		$parser->parse();
		return $parser;
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
		return preg_replace_callback('/gitroot:\/\/([\w.-_]+)/', function ($matches) {
			return Yii::app()->createUrl('post/view', array('path' => $matches[1]));
		}, $parser->content);
	}
	
	public function getFormattedCreated() {
		return GitBlog::formattedTimestamp($this->created);
	}
	
	protected function getMeta() {
		if ($this->metaArray == null) {
			$this->metaArray = $this->getParser()->parseMetaData($this->meta);
		}
		return $this->metaArray;
	}
	
	public function getAttachedTags() {
		$meta = $this->getMeta();
		$tags = array();
		if (isset($meta['tags'])) {
			$tags = Tag::loadAllByNames($meta['tags']);
		}
		return $tags;
	}
	
	public function getCategory() {
		$meta = $this->getMeta();
		return Category::loadByName($meta['category']);
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
	
	/**
	 * Fetch all revisons by postId.
	 * 
	 * @param integer $postId
	 * @return PostRevision[]
	 */
	public static function fetchAllRevisions($postId) {
		$criteria = new CDbCriteria();
		$criteria->addColumnCondition(array('post_id' => $postId));
		return self::model()->findAll($criteria);
	}
}
