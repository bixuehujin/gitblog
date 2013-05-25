<?php
/**
 * ViewController class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

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
		$id = Yii::app()->getRequest()->getQuery('id', 0);
		
		$layout = $this->getPageLayout();
		if (Yii::app()->user->getIsGuest()) {
			
		}else {
			$layout->addColumnItem('right', 'application.widgets.UserShow');
		}
		
		$dataPravider = Post::fetchProviderByCategoryId($id);
		
		$this->render('category', array(
			'provider' => $dataPravider,
		));
	}
	
	/**
	 * View by topics.
	 */
	public function actionTopic() {
		
		$this->render('topic', array());
	}
	
	/**
	 * view posts by user.
	 */
	public function actionUser() {
		$id = Yii::app()->request->getQuery('id', 0);
		if (!$id || !($user = User::load($id))) {
			throw new CHttpException(404, '访问页面不存在');
		}
		
		$dataProvider = Post::fetchProviderByAuthor($user->uid);
		
		$this->render('user', array(
			'provider' => $dataProvider,
		));
	}
	
	/**
	 * view posts by tag.
	 */
	public function actionTag() {
		$id = Yii::app()->request->getQuery('id', 0);
		if(!$id || !($tag = Tag::load($id))) {
			throw new CHttpException(404, '访问页面不存在');
		}
		
		$layout = $this->getPageLayout();
		$layout->addColumnItem('right', 'application.widgets.TagShow', array('tag' => $tag));
		
		$provider = Post::fetchProviderByTag($id);
		
		$this->render('tag', array(
			'provider' => $provider,
			'tag' => $tag,
		));
	}
	
	/**
	 * view all comments in a single page.
	 */
	public function actionComments() {
		$id = Yii::app()->request->getQuery('id', 0);
		if(!$id || !($post = Post::load($id))) {
			throw new CHttpException(404, '访问页面不存在');
		}
				
		$commentForm = new CommentForm(null, $post);
		
		$this->render('comments', array(
			'post' => $post,
			'commentForm' => $commentForm,
		));
	}
	
}