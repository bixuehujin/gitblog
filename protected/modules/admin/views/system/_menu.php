<?php $this->widget('zii.widgets.CMenu', array(
	'htmlOptions' => array('class'=>'nav nav-tabs nav-stacked'),
		'items' => array(
				array('label'=>'站点信息', 'url'=>array('/admin/system/website')),
				array('label'=>'其他', 'url'=>array('/admin/system/article')),
				array('label'=>'其他', 'url'=>array('/admin/system/comment')),
		),
	));
?>
