<?php
/**
 * view all commtents in a single page.
 * 
 * @var CActiveDataProvider $provider The DataProvider of comment objects.
 * @var Post $post object comments attached to.
 */
?>

<?php 
$this->setBreadcrumbs(array(
	$post->title=>array('/post/view', 'id'=>$post->pid),
	'评论列表'
));
?>

<?php $this->renderPartial('/comment/_comment_form', array('commentForm'=>$commentForm, 'post'=>$post))?>

<?php 
$this->renderPartial('/comment/_comments', array('provider'=>$post->getCommentProvider()));
?>

