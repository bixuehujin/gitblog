<?php 
/**
 * view posts by category.
 * 
 * @var $this Controller
 * @var $post Post object
 * @var $pagination Pagination 
 */
?>

<?php
if (isset($_GET['id'])) {
	$this->breadcrumbs = array('分类'=>'#') 
		+ Category::getCategoryBreadcrumbsArray($_GET['id']);
}
?>

<?php $this->renderPartial('/post/_posts', array('posts'=>$posts))?>
<?php $this->renderPartial('/common/_pager', array('pagination'=>$pagination))?>

<?php $this->widgets = array(
	'application.widgets.WeiboShow'=>array(
		'uid'=>'1747900082',
		'showFans'=>0,
		'height'=>400,
	),		
);?>
