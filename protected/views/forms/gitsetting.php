<?php 
/**
 * Git setting form template page.
 * 
 * @var GitSettingForm $model
 */
?>

<?php 
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id' => 'gitsetting-form',
	'type' => 'horizontal',
));
?>

<?php echo Yii::app()->console->render();?>
<section>
	
	<?php echo $form->textFieldRow($model, 'repository')?>
	
	<?php echo $form->textFieldRow($model, 'branch')?>
	
	<div class="control-group">
		<div class="controls">
			<?php echo CHtml::submitButton(Yii::t('view', 'Save'), array('class'=>'btn btn-primary'))?>
			<?php echo CHtml::resetButton(Yii::t('view', 'Reset'), array('class'=>'btn'))?>
		</div>
	</div>
</section>

<?php 
$this->endWidget();
?>
