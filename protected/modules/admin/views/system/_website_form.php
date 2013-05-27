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
<legend>站点信息</legend>
<section>
	<?php echo CHtml::errorSummary($model, '表单输入有误，请核对再提交:', null, array('class'=>'alert alert-error'))?>
	<?php echo Yii::app()->sessionMessager->renderMessageWidget();?>

	
	<?php echo $form->textFieldRow($model, 'site_name')?>

	<?php echo $form->textFieldRow($model, 'site_desp')?>
	
	<?php echo $form->textFieldRow($model, 'site_slogan')?>

	<?php echo $form->radioButtonListInlineRow($model, 'site_register_on', array('0' => '关闭', '1' => '开启'))?>
	
	<?php echo $form->textFieldRow($model, 'site_email')?>
	
	<div class="control-group">
		<div class="controls">
			<?php echo CHtml::submitButton('保存', array('class'=>'btn btn-primary')); ?>
			<?php echo CHtml::resetButton('重置', array('class'=>'btn')); ?>
		</div>
	</div>
	
</section>


<?php $this->endWidget();?>
