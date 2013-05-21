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
$this->getPageLayout()
	->addColumnItem('right', 'application.widgets.TagWidget', array(
		'tags' => $post->attachedTags))
	->addColumnItem('right', 'application.widgets.PostNavigationWidget', array(
		'navItems'=>$post->content->getFormattedReference(), 'htmlOptions' => array('class' => 'navigation affix')))
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

	
<?php $this->renderPartial('_post_view', array('post'=>$post))?>

<?php 
	$this->renderPartial('/comment/_comment_form', array(
		'commentForm' => $commentForm,
		'post' => $post,
	));
?>
<?php 
	$this->renderPartial('/comment/_comments', array(
		'comments'=>$comments, 
		'post'=>$post,
		'showAllLink'=>true,
	))
?>

