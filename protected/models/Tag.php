<?php
class Tag extends ActiveRecord {
	
	static public function model($className = __CLASS__) {
		return parent::model($className);
	}
	
	public function tableName() {
		return 'tag';
	}
	
	/**
	 * get tag infomation by tagId.
	 * @param integer $tagId
	 */
	static public function getTag($tagId) {
		return self::model()->find('tag_id=' . $tagId);
	}
	
	/**
	 * get tags infomation by tag name.
	 * 
	 * @param mixed $tags 
	 * @return array tagName indexed array, contains id and name. if a tag doesn't exist
	 * its id will be null.
	 */
	static public function getTagsInfo($tags) {
		if (is_string($tags)) {
			$tags = explode(',', $tags);
			foreach($tags as &$tag) {
				$tag = trim($tags);
			}
		}
		if (empty($tags)) return array();
		
		$criteria = new CDbCriteria();
		$criteria->addInCondition('name', $tags);
		
		$ntags = self::model()->findAll($criteria);
		$ntags = self::listToArray($ntags, 'name');
		$ret = array();
		foreach ($tags as $tag) {
			$ret[$tag] = array(
				'id'=>isset($ntags[$tag]['tag_id']) ? $ntags[$tag]['tag_id'] : null,
				'name' => $tag,
			);
		}
		return $ret;
	}
	
	/**
	 * 
	 * @param array $tagsInfo returned by $this->getTagsInfo()
	 * @param array 
	 */
	static public function getNewTags($tagsInfo) {
		$ret = array();
		foreach ($tagsInfo as $key => $tag) {
			if($tag['id'] == null) {
				$ret[$key] = $tag;
			}
		}
		return $ret;
	}
	
	/**
	 * insert tags in batch mode.
	 * 
	 * @param array $tags
	 */
	static public function addTagsBatch($tags) {
		$ret = array();
		foreach($tags as $tag) {
			$model = new Tag();
			//$model->tag_id = isset($tag['id']) ? $tag['id'] : $tag['tag_id'];
			$model->name = $tag['name'];
			if (isset($tag['description'])) {
				$model->description = $tag['description'];
			}
			$ret[$tag['name']] = array(
				'id'=>$model->save(false) ? $model->tag_id : null,
				'name' => $tag['name'],	
			);
		}
		return $ret;
	}
	
	/**
	 * check for specified tag is exist.
	 * 
	 * @param mixed $tagId
	 */
	static public function checkExist($tagId) {
		return (bool)self::model()->find('tag_id=' . $tagId);
	}
	
}