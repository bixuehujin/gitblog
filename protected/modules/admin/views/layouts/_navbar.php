<?php 
/**
 * Global top menu bar.
 */
?>

<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
		<div class="nav-collapse collapse">
			<?php $this->widget('zii.widgets.CMenu', array(
				'htmlOptions' => array('class'=>'nav'),
				'items' => $this->menu,
			))?>
			
		</div>
	</div>
</div>
