<?php
class Category extends CActiveRecord {
	
	static public function model($className = __CLASS__) {
		return parent::model($className);
	}
	
	public function tableName() {
		return 'category';
	}
	
	/**
	 * Fetch a list of categories.
	 * @param integer $parent
	 */
	public function getList($parent = 0) {
		$res = $this->findAll('parent=' . $parent);
		return $res;
	}

	
	public function getSubCategoryIDs($parent = 0) {
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
	 * consturct breadcrumbs array used to render a breadcrumb navagation.
	 * 
	 * @param integer $id
	 * @return array
	 */
	static public function getCategoryBreadcrumbsArray($id, $markFirst = true) {
		//TODO proformace issues on a log of categories.
		$categories = Category::model()->findAll();
		$path = array();
		while ($id != 0) {
			foreach ($categories as $category) {
				if($category->category_id == $id) {
					if($markFirst) {
						$path[] = $category->name;
						$markFirst = false;							
					}else {
						$path[$category->name] = array('/view/category', 'id'=>$category->category_id);
					}
					$id = $category->parent;
				}
			}
		}
		return array_reverse($path);
	}
	
	static public function getIdByName($name) {
		$category = Category::model()->find("name='$name'");
		return $category->category_id;
	}
}