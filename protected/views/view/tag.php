<?php
/**
 * view posts by tag.
 * 
 * @var $posts: array of Post object.
 * @var $pagination 
 */
?>

<?php 
$this->setBreadcrumbs(array(
	'标签'=>'#',
	$tag->name,
));
?>

<?php $this->renderPartial('/post/_posts', array('provider'=>$provider))?>

