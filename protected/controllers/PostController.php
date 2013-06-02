<?php
/**
 * PostController class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

class PostController extends Controller {
	
	/**
	 * declare permissions needed by this Controller.
	 * 
	 * @return array
	 */
	public function permissions() {
		return array(
			'post.create'=>array(
				'name'=>'post.create',
				'description'=>'Create New Post',
			),
			'post.editOwn'=>array(
				'name'=>'post.editOwn',
				'description'=>'Edit Own Post',
			),
			'post.editAny'=>array(
				'name'=>'post.editAny',
				'description'=>'Edit Any Post',
			),
			'post.deleteOwn'=>array(
				'name'=>'post.deleteOwn',
				'description'=>'Delete Own Post',
			),
			'post.deleteAny'=>array(
				'name'=>'post.deleteAny',
				'description'=>'Delete Any Post',
			),
		);
	}
	
	/**
	 * Action to update the visitors count of a post.
	 */
	public function actionVisitors() {
		$request = Yii::app()->getRequest();
		$id = $request->getParam('id', 0);
		if (!$request->getIsAjaxRequest()) {
			throw new CHttpException(404);
		}
		$ajax = new AjaxReturn();
		if (!$id || !($post = Post::load($id))) {
			$ajax->setCode(100)->setMsg('The post id maybe not correct.')->send();
		}
		if (!$post->updateVisitors()) {
			$ajax->setCode(300)->setMsg('Update the visitors counter failed');
		}
		$ajax->send();
	}
	
	public function actionView() {
		$request = Yii::app()->getRequest();
		$id = $request->getQuery('id', 0);
		$path = $request->getQuery('path', null);
		$rid = $request->getQuery('rid', 0);
		if($id && ($post = Post::load($id))) {
		}elseif ($path && ($post = Post::loadByPath($path))) {
		}else {
			throw new CHttpException(404);
		}
		
		$layout = $this->getPageLayout();
		$layout->addColumnItem('right', 'application.widgets.UserShow', array(
			'user' => $post->getAuthor(),
			'showTitle' => true,
		));
		$layout->addColumnItem('right', 'application.widgets.PostCommitter', array('committers' => $post->getCommitters()));
		$layout->addColumnItem('right', 'application.widgets.PostStatus', array('post' => $post, 'countVisitors' => !$rid));
		$layout->addColumnItem('right', 'application.widgets.PostNavigation', array('navItems' => $post->content->getFormattedReference()));
		if ($rid) {
			$revision = PostRevision::model()->findByPk($rid);
			$layout->addColumnItem('right', 'application.widgets.CommitMessage', array('revision' => $revision));
			$this->setBreadcrumbs(Category::getCategoryBreadcrumbsArray($revision->getCategory()->cid));
			$this->render('revision', array(
				'post' => $post,
				'revision' => $revision,
			));
			Yii::app()->end();
		}
		
		$commentForm = new CommentForm(null, $post);
		
		if(isset($_POST['CommentForm'])) {
			$commentForm->attributes = $_POST['CommentForm'];
			if ($commentForm->save()) {
				$this->refresh(true, '#comment-form');
			}
		}

		$this->setBreadcrumbs(Category::getCategoryBreadcrumbsArray($post->cid));

		$this->render('view', array(
			'post' => $post,
			'commentForm' => $commentForm,
		));
	}
	
	public function actionRevisions() {
		$id = Yii::app()->request->getQuery('id', 0);
		if (!$id || !($post = Post::load($id))) {
			throw new CHttpException(404);
		}
		$this->setBreadcrumbs(array(
			$post->title => array('post/view', 'id' => $post->pid),
			'版本修订历史'
		));
		
		$layout = $this->getPageLayout();
		$layout->addColumnItem('right', 'application.widgets.PostStatus', array('post' => $post, 'countVisitors' => false));
		
		$this->render('revisions', array(
			'post' => $post,
			'revisions' => $post->getRevisions(),
		));
	}
}
