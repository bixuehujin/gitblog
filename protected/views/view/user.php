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
$this->setBreadcrumbs(array(
	'用户归档'=>'#',
	User::getName($_GET['id']),
));
?>

<?php $this->renderPartial('/post/_posts', array('provider'=>$provider))?>


<?php 
$this->widgets += array(
	'application.widgets.WeiboShow'=>array('uid'=>1747900082),
);
?>
