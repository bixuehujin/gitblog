<?php
class PostController extends Controller {
	
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