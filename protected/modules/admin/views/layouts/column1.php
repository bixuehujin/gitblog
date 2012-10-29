<?php 
	Yii::app()->clientScript->registerPackage('bootstrap.responsive')
		->registerCoreScript('jquery')
		->registerScriptFile($this->baseUrl . '/js/admin.js');
?>
<?php $this->beginContent('//layouts/main'); ?>
	<?php echo $content; ?>
	
<?php $this->endContent(); ?>