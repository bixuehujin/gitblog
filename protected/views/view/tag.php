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
	Yii::t('view', 'tag')=>'#',
	$tag->name,
));
?>

<?php $this->renderPartial('/post/_posts', array('provider'=>$provider))?>

