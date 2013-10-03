<?php 
/**
 * System website wide configuration form template file.
 * 
 * @var SystemWebsiteForm $model
 */
?>
<?php 
	$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id' => 'global-form',
		'type' => 'horizontal',
	));
?>
<legend><?php echo Yii::t('admin', 'Site information')?></legend>
<section>
	<?php echo CHtml::errorSummary($model, null, null, array('class'=>'alert alert-error'))?>
	<?php echo Yii::app()->console->render();?>

	
	<?php echo $form->textFieldRow($model, 'site_name')?>

	<?php echo $form->textFieldRow($model, 'site_desp')?>
	
	<?php echo $form->textFieldRow($model, 'site_slogan')?>

	<?php echo $form->radioButtonListInlineRow($model, 'site_register_on', array('0' => Yii::t('admin', 'Off'), '1' => Yii::t('admin', 'On')))?>
	
	<?php echo $form->textFieldRow($model, 'site_email')?>
	
	<div class="control-group">
		<div class="controls">
			<?php echo CHtml::submitButton(Yii::t('admin', 'Save'), array('class'=>'btn btn-primary')); ?>
			<?php echo CHtml::resetButton(Yii::t('admin', 'Reset'), array('class'=>'btn')); ?>
		</div>
	</div>
	
</section>


<?php $this->endWidget();?>
