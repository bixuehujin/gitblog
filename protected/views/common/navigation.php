<?php
/**
 * Category navigation template file.
 */
?>
<?php 

?>

<div id="navigation">
	<?php $this->widget('ext.bootstrap.widgets.TbMenu', array(
		'id' => 'navigation-primary',
		'type' => 'pills',
		'items' => Category::model()->buildPrimaryMenu(),
	))?>
	
	<?php $this->widget('ext.bootstrap.widgets.TbMenu', array(
		'id' => 'navigation-secondary',
		'type' => 'pills',
		'items' => Category::model()->buildSecondaryMenu(),
	))?>
</div>

