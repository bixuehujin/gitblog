<?php 
/**
 * view a single post.
 * 
 * @var $this Controller
 * @var $post Post object to render.
 * @var $commentForm CommentForm
 * @var $comments array of Comment object.
 */
?>
<?php 
Yii::app()->clientScript->registerPackage('bootstrap.plugins')
	->registerPackage('jquery.scrollTo')
	->registerScriptFile(Yii::app()->getBaseUrl(). '/js/post-view.js')
	->pregisterCssFile(__DIR__ . '/post.css');
?>
<?php
	$this->pageTitle = $post->title . ' | ' . $this->pageTitle;
?>


<?php $this->renderPartial('_post', array('post'=>$post))?>

<?php 
	$this->renderPartial('/comment/_comment_form', array(
		'commentForm' => $commentForm,
		'post' => $post,
	));
?>
<?php 
	$this->renderPartial('/comment/_comments', array(
		'provider'=>$post->getCommentProvider(), 
		'post'=>$post,
		'showAllLink'=>true,
	))
?>

