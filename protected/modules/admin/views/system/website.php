<?php

?>
<div class="row">
	<div class="span3">
		<?php $this->renderPartial('/common/_menu', array('items'=>$items))?>	
	</div>
	
	<div class="span9">
		
		<?php echo Yii::app()->sessionMessager->renderMessageWidget();?>
		
		<?php $this->renderPartial('_website_form', array('model'=>$model))?>
	</div>
</div>