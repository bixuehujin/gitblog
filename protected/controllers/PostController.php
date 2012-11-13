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
	
	
	public function actionView() {
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		if(!$id) {
			throw new CHttpException(404);
		}
		
		$postModel = Post::model();
		$post = $postModel->find('post_id=' . $id);
		
		if(!$post) {
			throw new CHttpException(404);
		}
		
		//visibility checking
		if($post->visibility == Post::VISIBILITY_SELF) { //only the author can view the post
			if(Yii::app()->user->id != $post->uid) {
				throw new CHttpException(404);
			}
		}
		
		$commentModel = Comment::model();
		
		$options['condition'] = 'post_id=' . $id;
		$options['order'] = 'comment_id DESC';
		
		$comments = $commentModel->findAll($options);
		
		$commentForm = new CommentForm();
		
		if(isset($_POST['CommentForm'])) {
			$commentForm->attributes = $_POST['CommentForm'];
			if ($commentForm->save()) {
				Yii::app()->sessionMessager->addMessage('发表评论成功', 'success');
				$this->refresh(true, '#comment-form');
			}
		}
		
		$this->render('view', array(
			'post' => $post,
			'comments' => $comments,
			'commentForm' => $commentForm,
		));
	}
}
