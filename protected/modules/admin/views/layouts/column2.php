<?php 
	Yii::app()->clientScript->registerPackage('bootstrap.responsive')
		->registerCoreScript('jquery')
		->registerScriptFile(Yii::app()->getBaseUrl() . '/js/admin.js');
?>
<?php $this->beginContent('/layouts/admin'); ?>

	<div class="row">
		<div class="span3">
			<?php $this->renderPartial('/common/_menu', array('items'=>$this->menuItems()))?>
		</div>
		<div class="span9">
			<?php echo $content?>
		</div>
	</div>
<?php $this->endContent(); ?>
