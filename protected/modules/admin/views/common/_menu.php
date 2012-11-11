<?php 
/**
 * side menu navagation.
 * $items: arguments pass to CMenu::items
 */
?>

<?php $this->widget('bootstrap.widgets.TbMenu', array(
		//'htmlOptions' => array('class'=>'nav nav-tabs nav-stacked'),
		'items' => $items,
		'type'=>'list',
		'stacked'=>true,
	));
?>
