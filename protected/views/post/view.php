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
	->registerScriptFile(Yii::app()->getBaseUrl(). '/js/post-view.js');
?>
<?php
	$this->pageTitle = $post->title . ' | ' . $this->pageTitle;
	$this->breadcrumbs = Category::getCategoryBreadcrumbsArray($post->category->category_id, false)
		+ array($post->title);
?>

	
<?php $this->renderPartial('_post_view', array('post'=>$post))?>

<?php 
	$this->renderPartial('/comment/_comment_form', array(
		'commentForm' => $commentForm,
		'post' => $post,
	));
?>
<?php $this->renderPartial('/comment/_comments', array('comments'=>$comments, 'post'=>$post))?>
<?php echo CHtml::link('查看全部评论', array('/view/comments', 'id'=>$post->post_id))?>


<?php 
$this->widgets += array(
	'application.widgets.TagWidget'=>array('tags'=>$post->tags),
	'application.widgets.PostNavigationWidget'=>array(
		'navItems'=>$post->content->reference,
	),
);
?>
