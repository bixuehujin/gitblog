<?php
/**
 * FeedController class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 * @since 2013-04-21
 */

class FeedController extends Controller {
	
	public $defaultAction = 'home';
	
	public function beforeAction($action) {
		Yii::app()->getComponent('layout')->addColumnItem('left', '/feed/_menu');
		return true;
	}
	
	public function actionHome() {
		
		$this->render('home');
	}
	
	public function actionTopic() {
		
		$this->render('topic');
	}
	
	public function actionComment() {
		
		$this->render('comment');
	}
	
	public function actionPublish() {
	$postForm = new PostForm();
		if (isset($_POST['PostForm'])) {
			$postForm->setAttributes($_POST['PostForm']);
			if ($postForm->save()) {
				$this->refresh();
			}
		}
		
		$this->render('publish', array(
			'model' => $postForm,
		));
	}
	
	public function actionPublish2() {
		$postForm = new PostForm();
		if (isset($_POST['PostForm'])) {
			$postForm->setAttributes($_POST['PostForm']);
			if ($postForm->save()) {
				$this->refresh();
			}
		}
		$this->render('publish', array(
			'model' => $postForm,
		));
	}
}
