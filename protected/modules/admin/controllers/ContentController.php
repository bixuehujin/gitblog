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
			array('label'=>'分类管理', 'url'=>array('/admin/content/category')),
			array('label'=>'文档管理', 'url'=>array('/admin/content/article')),
			array('label'=>'评论评论', 'url'=>array('/admin/content/comment')),
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