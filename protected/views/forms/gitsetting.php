<?php 
/**
 * Git setting form template page.
 * 
 * @var GitSettingForm $model
 */
?>

<?php 
$form = $this->beginWidget('ext.bootstrap.widgets.TbActiveForm', array(
	'id' => 'gitsetting-form',
	'type' => 'horizontal',
));
?>

<?php echo Yii::app()->sessionMessager->renderMessageWidget();?>
<section>
	
	<?php echo $form->textFieldRow($model, 'repository')?>
	
	<?php echo $form->textFieldRow($model, 'branch')?>
	
	<div class="control-group">
		<div class="controls">
			<?php echo CHtml::submitButton('保存', array('class'=>'btn btn-primary'))?>
			<?php echo CHtml::resetButton('重置', array('class'=>'btn'))?>
		</div>
	</div>
</section>

<?php 
$this->endWidget();
?>
