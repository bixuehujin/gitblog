<?php
/**
 * Category AR class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */


/**
 * @property integer $cid
 * @property string  $name
 * @property string  $mname
 * @property string  $description
 * @property integer $weight
 */
class Category extends Tree {

	public function getCid() {
		return $this->tid;
	}
	
	public function vocabulary() {
		$vocabulary = TermVocabulary::loadByMName('category');
		if (!$vocabulary) {
			$vocabulary = new TermVocabulary();
			$vocabulary->name = 'category';
			$vocabulary->mname = 'category';
			$vocabulary->save(false);
		}
		return $vocabulary;
	}
	
	protected function buildMenu($cid, $activeCid) {
		$children = self::fetchChildren($cid);
		$menu = array();
		foreach ($children as $item) {
			$menu[] = array(
				'label' => $item->name,
				'url' => array('', 'id' => $item->cid),
				'active' => $activeCid == $item->cid,
			);
		}
		return $menu;
	}
	
	public function buildPrimaryMenu() {
		$activeCid = Yii::app()->request->getQuery('id', 0);
		$menu = $this->buildMenu(0, $activeCid);
		$menu[] = array(
			'label' => Yii::t('view', 'All'),
			'url' => array(''),
			'active' => $activeCid == 0,
		);
		return $menu;
	}
	
	public function buildSecondaryMenu() {
		$activeId = Yii::app()->request->getQuery('id', 0);
		if (!$activeId) {
			return array();
		}
		$cid = $activeId;
		if (($cat = self::load($activeId)) && ($parent = $cat->getParent())) {
			$cid = self::load($parent)->tid;
		}
		return $this->buildMenu($cid, $activeId);
	}
	
	/**
	 * check if a category is exsit.
	 * 
	 * @param integer $categoryId
	 */
	public function checkExist($categoryId) {
		return (bool)$this->find('category_id=:id', array(':id' => (int)$categoryId));
	}
	
	
	/**
	 * Fetch a list of categories.
	 * @param integer $parent
	 */
	public function getList($parent = 0) {
		$res = $this->findAll('parent=:parent', array(':parent' => (int)$parent));
		return $res;
	}

	/**
	 * Fetch all sub categoryIds, contains the parent itself.
	 * 
	 * @param integer $parent
	 * @return mixed if $parent !=0 and the category do not exsit, null will returned, 
	 * otherwise a array contains all sub categoryId will be returned.
	 */
	public function getChildrenIds($parent = 0) {
		if($parent != 0 && !$this->checkExist($parent)) {
			return null;
		}
		$tids = TermHierarchy::fetchChildren($parent);
		if ($parent != 0) {
			$tids[] = $parent;
		}
		return $tids;
	}
	
	/**
	 * Load a category by its name.
	 * 
	 * @param string $name
	 * @return Category
	 */
	public static function loadByName($name) {
		return static::model()->findByAttributes(array(
			'name' => $name
		));
	}
	
	/**
	 * consturct breadcrumbs array used to render a breadcrumb navagation.
	 * 
	 * @param integer $id
	 * @return array
	 */
	public static function getCategoryBreadcrumbsArray($id) {
		$path  = self::load($id)->getPath();
		$ret = array();
		$last = array_pop($path);
		foreach ($path as $item) {
			$ret[$item->name] = array('view/category', 'id' => $item->cid);
		}
		if ($last) {
			$ret[] = $last->name;
		}
		return $ret;
	}
}
