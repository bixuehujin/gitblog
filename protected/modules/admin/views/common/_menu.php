<?php 
/**
 * side menu navagation.
 * $items: arguments pass to CMenu::items
 */
?>

<?php $this->widget('zii.widgets.CMenu', array(
	'htmlOptions' => array('class'=>'nav nav-tabs nav-stacked'),
		'items' => $items
	));
?>
