<?php
/**
 * controller for manage user contents, such as article, comments, categories. 
 * 
 * @author hujin
 */
class ContentController extends AdminController {
	
	public $defaultAction = 'category';
	
	public function menuItems() {
		return array(
			array('label'=>Yii::t('admin', 'Category Management'), 'url'=>array('/admin/content/category')),
			array('label'=>Yii::t('admin', 'Article Management'), 'url'=>array('/admin/content/article')),
			array('label'=>Yii::t('admin', 'Comment Management'), 'url'=>array('/admin/content/comment')),
		);
	}
	
	public function actionCategory() {
		$category = Category::model();
		
		$this->render('category', array(
			'items' => $this->menuItems()		
		));
	}
	
	
	public function actionArticle() {
		
		$this->render('article', array(
			'items' => $this->menuItems()		
		));
	}
	
	
	public function actionComment() {
	
		$this->render('comment', array(
			'items' => $this->menuItems()		
		));
	}
}