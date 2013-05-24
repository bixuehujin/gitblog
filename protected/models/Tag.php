<?php
/**
 * Tag AR class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

/**
 * @property integer $tid
 * @property string  $name
 * @property string  $description
 */
class Tag extends Term {
	
	public function vocabulary() {
		$vocabulary = TermVocabulary::loadByMName('tag');
		if (!$vocabulary) {
			$vocabulary = new TermVocabulary();
			$vocabulary->name = '标签';
			$vocabulary->mname = 'tag';
			$vocabulary->save(false);
		}
		return $vocabulary;
	}
	
	/**
	 * get tag infomation by tagId.
	 * @param integer $tagId
	 */
	public static function getTag($tagId) {
		return self::model()->find('tag_id=' . $tagId);
	}
	
	/**
	 * get tags infomation by tag name.
	 * 
	 * @param mixed $tags 
	 * @return array tagName indexed array, contains id and name. if a tag doesn't exist
	 * its id will be null.
	 */
	public static function getTagsInfo($tags) {
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
	public static function getNewTags($tagsInfo) {
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
	public static function addTagsBatch($tags) {
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
	 * Load a tag by its name.
	 * 
	 * @param string $name
	 * @return Tag
	 */
	public static function loadByName($name, $autoCreate = false) {
		$ret = static::model()->findByAttributes(array(
			'name' => $name
		));
		if (!$ret && $autoCreate) {
			$ret = Tag::create($name);
		}
		return $ret;
	}
	
	/**
	 * Load all tags from database.
	 * 
	 * @param string|array $tags
	 * @return Tag[]
	 */
	public static function loadAllByNames($tags) {
		$ret = array();
		if (is_string($tags)) {
			$tags = explode(',', $tags);
			foreach ($tags as $tag) {
				if ($o = static::loadByName(trim($tag))) {
					$ret[] = $o;
				}
			}
		}
		return $ret;
	}
}
