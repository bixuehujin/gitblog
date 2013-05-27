<?php
/**
 * Reset password template file.
 * 
 * Required variables:
 * 
 * 
 */
?>

<?php $form = $this->beginWidget('ext.bootstrap.widgets.TbActiveForm', array(
	'id' => 'password-reset-form',
	'type' => 'vertical',
))?>


<?php echo $form->textFieldRow($model, 'email')?>

<div class="actions">
	<?php echo CHtml::submitButton('发送邮件', array('class'=>'btn')); ?>
</div>

<?php $this->endWidget()?>
