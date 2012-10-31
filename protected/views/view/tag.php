<?php
/**
 * view posts by tag.
 * 
 * @var $posts: array of Post object.
 * @var $pagination 
 */
?>

<?php 
$this->breadcrumbs = array(
	'标签'=>'#',
	Tag::getTag($_GET['id'])->name
);
?>

<?php $this->renderPartial('/post/_posts', array('posts'=>$posts))?>

<?php $this->renderPartial('/common/_pager', array('pagination'=>$pagination))?>