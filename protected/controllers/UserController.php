<?php
/**
 * UserController class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

class UserController extends Controller {
	
	public $defaultAction = 'articles';
	
	public function getUid() {
		return Yii::app()->request->getQuery('id', Yii::app()->user->getId());
	}
	
	protected function beforeAction($action) {
		$layout = $this->getPageLayout();
		$user = User::load($this->uid);
		$layout->addColumnItem('right', 'application.widgets.UserShow', array('user' => $user));
		Yii::app()->getComponent('layout')->addColumnItem('right', '/user/_menu', array('user' => $user));
		return true;
	}
	
	public function actionArticles() {
		$provider = Post::fetchProviderByAuthor($this->uid, Post::TYPE_ARTICLE);
		$this->render('articles', array(
			'provider' => $provider,
		));
	}
	
	public function actionTopics() {
		$provider = Post::fetchProviderByAuthor($this->uid, Post::TYPE_TOPIC);
		$this->render('topics', array(
			'provider' => $provider,
		));
	}
	
	public function actionComments() {
		$type = Yii::app()->request->getQuery('type', 'received');
		if ($type === 'received') {
			$provider = Comment::fetchProviderOfReceived();
		}else {
			$provider = Comment::fetchProviderOfSent();
		}
		
		$this->render('comments', array(
			'provider' => $provider,
		));
	}
	
	public function actionMessages() {
		$id = Yii::app()->request->getQuery('id', Yii::app()->user->getId());
		$isGuest = Yii::app()->user->getIsGuest();
		
		$user = User::load($id);
		if (!$user) {
			throw new CHttpException(404);
		}
		
		$model = new CommentForm(null, $user);
		
		if (isset($_POST['CommentForm'])) {
			$model->setAttributes($_POST['CommentForm']);
			if ($model->save()) {
				$this->refresh();
			}
		}
		
		$this->render('messages', array(
			'model' => $model,
			'provider' => $user->getMessageProvider(),
		));
	}
	
	public function actionInfo() {
		
		$this->render('info', array());
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
}
