<?php
class ViewController extends Controller {
	
	public $defaultAction = 'category';
	
	
	/**
	 * view by category
	 */
	public function actionCategory() {
		
		$pageSize = Yii::app()->systemSettings->get('post_page_size') ?: 10;
		
		$criteria = new CDbCriteria();
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		if($id) {
			$cateIds = Category::model()->getSubCategoryIds($id);
			$cateIds = empty($cateIds) ? array($id) : $cateIds;
			$criteria->addInCondition('category_id', $cateIds);
		}
		$criteria->order = 'post_id DESC';
		
		
		$dataPravider = new CActiveDataProvider('Post', array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>$pageSize
			)		
		));
		$this->render('category', array(
			'posts' => $dataPravider->getData(),
			'pagination'=>$dataPravider->getPagination(),
		));
	}
	
	/**
	 * view posts by user.
	 */
	public function actionUser() {
		if (!isset($_GET['id'])) {
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
		if (!isset($_GET['id'])) {
			throw new CHttpException(404, '访问页面不存在');
		}
		$posts = Post::model()->getByTagId($_GET['id']);
		$this->render('tag', array(
			'posts'=>$posts
		));
	}
	
	/**
	 * view all comments in a single page.
	 */
	public function actionComments() {
		if(!isset($_GET['id'])) {
			throw new CHttpException(404, '访问页面不存在');
		}
		$criteria = new CDbCriteria();
		$criteria->condition = 'post_id=' . $_GET['id'];
		$criteria->order = 'comment_id DESC';
		
		$provider = new CActiveDataProvider('Comment', array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>Yii::app()->systemSettings->get('comment_page_size') ?: 10,
			),
		));
		
		$post = Post::model()->find('post_id=' . $_GET['id']);
		
		$this->render('comments', array(
				'comments'=>$provider->getData(),
				'post'=>$post,
				'pagination'=>$provider->getPagination(),
		));
	}
	
}