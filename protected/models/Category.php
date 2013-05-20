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
class Category extends Term {

	public function getCid() {
		return $this->tid;
	}
	
	public function vocabulary() {
		$vocabulary = TermVocabulary::loadByMName('category');
		if (!$vocabulary) {
			$vocabulary = new TermVocabulary();
			$vocabulary->name = '分类';
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
				'url' => array('', 'cid' => $item->cid),
				'active' => $activeCid == $item->cid,
			);
		}
		return $menu;
	}
	
	public function buildPrimaryMenu() {
		$activeCid = Yii::app()->request->getQuery('cid', 0);
		$menu = $this->buildMenu(0, $activeCid);
		$menu[] = array(
			'label' => '全部',
			'url' => array(''),
			'active' => $activeCid == 0,
		);
		return $menu;
	}
	
	public function buildSecondaryMenu() {
		$activeCid = Yii::app()->request->getQuery('cid', 0);
		if (!$activeCid) return array();
		
		return $this->buildMenu($activeCid, 0);
	}
	
	/**
	 * check if a category is exsit.
	 * 
	 * @param integer $categoryId
	 */
	public function checkExist($categoryId) {
		return (bool)$this->find('category_id=' . $categoryId);
	}
	
	
	/**
	 * Fetch a list of categories.
	 * @param integer $parent
	 */
	public function getList($parent = 0) {
		$res = $this->findAll('parent=' . $parent);
		return $res;
	}

	/**
	 * fetch all sub categoryIds, contains the parent itself.
	 * 
	 * @param integer $parent
	 * @return mixed if $parent !=0 and the category do not exsit, null will returned, 
	 * otherwise a array contains all sub categoryId will be returned.
	 */
	public function getSubCategoryIDs($parent = 0) {
		if($parent != 0 && !$this->checkExist($parent)) {
			return null;
		}
		$res = $this->getList($parent);
		$ret = array();
		foreach($res as $item) {
			$ret[] = $item->category_id;
		}
		if ($parent != 0) {
			$ret[] = $parent;
		}
		return $ret;
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
		$path  = self::fetchTermPath($id);
		
	}
}
