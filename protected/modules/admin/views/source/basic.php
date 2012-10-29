<?php
$labelOptions = array('class'=>'control-label');
?>

<?php 
$form = $this->beginWidget('CActiveForm', array(
	'id' => 'content-setting',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'htmlOptions'=>array('class'=>'form-horizontal')
));
?>

<legend>内容设定</legend>
<section>
	<div class="control-group">
		<?php echo $form->labelEx($contentSetting, 'github', $labelOptions);?>
		<div class="controls">
			<?php echo $form->textField($contentSetting, 'github')?>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo $form->labelEx($contentSetting, 'repository', $labelOptions);?>
		<div class="controls">
			<?php echo $form->textField($contentSetting, 'repository')?>
		</div>
	</div>
	
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