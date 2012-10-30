<?php
class ViewController extends Controller {
	
	public $defaultAction = 'category';
	
	/**
	 * view by cotegory
	 */
	public function actionCategory() {
		
		$postModel = Post::model();
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$posts = $postModel->getByCategoryId($id);
		$this->render('category', array(
			'posts' => $posts,
		));
	}
	
	/**
	 * view posts by user.
	 */
	public function actionUser() {
		if(!isset($_GET['id'])) {
			throw new CHttpException(404, '访问页面不存在');
		}
		$postModel = Post::model();
		$posts = $postModel->findAll(array(
			'order'=>'post_id DESC',
			'condition'=>'uid='. $_GET['id']		
		));
		$this->render('user', array(
			 'posts' => $posts,
		));
	}
	
	/**
	 * view posts by tag.
	 */
	public function actionTag() {
		$this->render('tag', array(
				
		));
	}
	
}