<?php $this->widget('zii.widgets.CMenu', array(
	'htmlOptions' => array('class'=>'nav nav-tabs nav-stacked'),
		'items' => array(
				array('label'=>'分类管理', 'url'=>array('/admin/content/category')),
				array('label'=>'文档管理', 'url'=>array('/admin/content/article')),
				array('label'=>'评论评论', 'url'=>array('/admin/content/comment')),
		),
	));
?>
