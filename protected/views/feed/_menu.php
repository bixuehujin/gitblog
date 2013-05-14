<?php
/**
 * Menu template for user feed page.
 * 
 */
?>

<?php $this->widget('bootstrap.widgets.TbMenu', array(
	'type' => 'list',
	'stacked' => true,
	'items' => array(
		array('label' => '我的文章', 'url' => array('/feed/home')),
		array('label' => '我的专题', 'url' => array('/feed/topic')),
		array('label' => '我的评论', 'url' => array('/feed/comment')),
		array('label' => '发表文章', 'url' => array('/feed/publish')),
		array('label' => '发表专题', 'url' => array('/feed/publish2')),
	),
))?>
