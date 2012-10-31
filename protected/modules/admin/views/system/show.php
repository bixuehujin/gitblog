<?php
/**
 * configure how system show contents.
 */
?>

<div class="row">
	<div class="span3">
		<?php $this->renderPartial('/common/_menu', array('items'=>$items))?>	
	</div>
	
	<div class="span9">
		<?php $this->renderPartial('_show_form', array('model'=>$model))?>
	</div>
</div>