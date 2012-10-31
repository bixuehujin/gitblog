<?php 
	$form = $this->beginWidget('CActiveForm', array(
		'id'=>'global-form',
		'htmlOptions'=>array('class'=>'form-horizontal')
	));
?>
<legend>站点信息</legend>
<section>
	<?php echo CHtml::errorSummary($model, '表单输入有误，请核对再提交:', null, array('class'=>'alert alert-error'))?>
	<?php echo Yii::app()->sessionMessager->renderMessageWidget();?>
	
	<div class="control-group">
		<?php echo $form->labelEx($model, 'site_name', array('class'=>'control-label'))?>
		<div class="controls">
			<?php echo $form->textField($model, 'site_name');?>
			<?php echo $form->error($model, 'site_name')?>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo $form->labelEx($model, 'site_desp', array('class'=>'control-label'))?>
		<div class="controls">
			<?php echo $form->textArea($model, 'site_desp')?>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo $form->labelEx($model, 'site_slogan', array('class'=>'control-label'))?>
		<div class="controls">
			<?php echo $form->textArea($model, 'site_slogan')?>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo $form->labelEx($model, 'site_email', array('class'=>'control-label'))?>
		<div class="controls">
			<?php echo $form->textField($model, 'site_email')?>
			<?php //echo $form->error($model, 'site_email')?>
		</div>
	</div>
	
	<div class="control-group">
		<div class="controls">
			<?php echo CHtml::submitButton('保存', array('class'=>'btn btn-primary')); ?>
			<?php echo CHtml::resetButton('重置', array('class'=>'btn')); ?>
		</div>
	</div>
	
</section>


<?php $this->endWidget();?>