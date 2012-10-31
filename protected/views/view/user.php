<?php
/**
 * view posts by user.
 * 
 * @var $this Controller
 * @var $posts array of Post object.
 * @var $pagination Pagination object used to render a pager.
 */
?>

<?php 
$this->breadcrumbs = array(
	'用户归档'=>'#',
	User::getName($_GET['id']),
);
?>

<?php $this->renderPartial('/post/_posts', array('posts'=>$posts))?>

<?php $this->renderPartial('/common/_pager', array('pagination'=>$pagination))?>

<?php 
$this->widgets += array(
	'application.widgets.WeiboWidget'=>array(),
);
?>