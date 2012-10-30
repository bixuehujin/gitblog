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
		return $ret;
	}
	
	
	/**
	 * consturct breadcrumbs array used to render a breadcrumb navagation.
	 * 
	 * @param integer $id
	 * @return array
	 */
	static public function getCategoryBreadcrumbsArray($id) {
		//TODO proformace issues on a log of categories.
		$categories = Category::model()->findAll();
		$isFirst = true;
		$path = array();
		while ($id != 0) {
			foreach ($categories as $category) {
				if($category->category_id == $id) {
					if($isFirst) {
						$path[] = $category->name;
						$isFirst = false;							
					}else {
						$path[$category->name] = array('/view/category', 'id'=>$category->category_id);
					}
					$id = $category->parent;
				}
			}
		}
		return array_reverse($path);
	}
}