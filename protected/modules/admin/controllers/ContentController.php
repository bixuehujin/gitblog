<?php
/**
 * controller for manage user contents, such as article, comments, categories. 
 * 
 * @author hujin
 *
 */
class ContentController extends AdminController {
	
	public $defaultAction = 'category';
	
	public function actionCategory() {
		$this->render('category', array());
	}
	
	
	public function actionArticle() {
		
		$this->render('article', array());
	}
	
	
	public function actionComment() {
	
		$this->render('comment', array());
	}
}