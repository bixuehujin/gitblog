<?php 
Yii::app()->clientScript->registerPackage('bootstrap.responsive')
	->registerCoreScript('jquery')
	->registerScriptFile(Yii::app()->getBaseUrl() . '/js/admin.js');
?>

<?php $this->beginContent('/layouts/admin'); ?>

	<div class="row-fluid">
		<div class="span3">
			<?php $this->renderPartial('/common/_menu', array('items'=>$this->menuItems()))?>
		</div>
		<div class="span9 section">
			<div class="head">
				<legend><?php echo $this->sectionTitle?></legend>
			</div>
			<?php if (Yii::app()->console->hasMessages):?> 
				<div class="messages">
					<?php echo Yii::app()->console->render();?>
				</div>
			<?php endif;?>
			<div class="content">
				<?php echo $content?>
			</div>
		</div>
	</div>
<?php $this->endContent(); ?>
