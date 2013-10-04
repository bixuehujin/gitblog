<?php
class CommentController extends Controller {
	
	public function actionCreate() {
		$comment = new CommentForm();
		$comment->attributes = $_POST['CommentForm'];
		
		$this->preformAjaxCreate($comment);
		
		if($comment->save()) {
			Yii::app()->console->addSuccess('添加评论成功');
		}else {
			Yii::app()->console->addError('添加评论失败');
		}
		$url = CHtml::normalizeUrl(array('/post/view', 'id'=>$_POST['CommentForm']['post_id'])) 
			. '#comment-form';
		$this->redirect($url);
	}
	
	
	protected function preformAjaxCreate($comment) {
		if (isset($_POST['ajax']) && $_POST['ajax'] == 'comment-form') {
			Yii::app()->end();
		}
	}
	
	public function actionDelete() {
		
	}
	
}