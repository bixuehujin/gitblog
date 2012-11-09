<?php
/**
 * view all commtents in a single page.
 * 
 * @var $comments array of Comment object.
 * @var $post Post object comments attached to.
 */
?>

<?php 
$this->breadcrumbs = array(
	$post->title=>array('/post/view', 'id'=>$post->post_id),
	'评论列表'
);
?>

<?php $this->renderPartial('/comment/_comment_form', array('commentForm'=>$commentForm, 'post'=>$post))?>

<?php 
$this->renderPartial('/comment/_comments', array('comments'=>$comments, 'post'=>$post));
?>

<?php
//render pager
$this->renderPartial('/common/_pager', array('pagination'=>$pagination));
?>

