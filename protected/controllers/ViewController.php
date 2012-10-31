<?php
class ViewController extends Controller {
	
	public $defaultAction = 'category';
	
	/**
	 * get data provider used by category, user, tag action.
	 * 
	 * @param mixed $criteria
	 */
	protected function getPostDataProvider($criteria) {
		return new CActiveDataProvider('Post', array(
			'criteria' => $criteria,
			'pagination' => array(
				'pageSize'=>Yii::app()->systemSettings->get('post_page_size') ?: 20,	
			)		
		));
	}
	
	
	/**
	 * view by category
	 */
	public function actionCategory() {
		
		$criteria = new CDbCriteria();
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		if($id) {
			$cateIds = Category::model()->getSubCategoryIds($id);
			$cateIds = empty($cateIds) ? array($id) : $cateIds;
			$criteria->addInCondition('category_id', $cateIds);
		}
		
		$criteria->order = 'post_id DESC';
		
		
		$dataPravider = $this->getPostDataProvider($criteria);
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
		
		$dataProvider = $this->getPostDataProvider(array(
			'order'=>'post_id DESC',
			'condition'=>'uid=' . $_GET['id'],		
		));
		
		$this->render('user', array(
			'posts' => $dataProvider->getData(),
			'pagination' => $dataProvider->getPagination(),
		));
	}
	
	/**
	 * view posts by tag.
	 */
	public function actionTag() {
		if (!isset($_GET['id'])) {
			throw new CHttpException(404, '访问页面不存在');
		}
		
		$postIds = PostTag::model()->getPostIds($_GET['id']);
		if(!empty($postIds)) {
			$criteria = new CDbCriteria();
			$criteria->addInCondition('post_id', $postIds);
			$dataProvider = $this->getPostDataProvider($criteria);
			$maps['posts'] = $dataProvider->getData();
			$maps['pagination'] = $dataProvider->getPagination();
		}else {
			$maps['posts'] = array();
			$maps['pagination'] = null;
		}
		
		$posts = Post::model()->getByTagId($_GET['id']);
		$this->render('tag', $maps);
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