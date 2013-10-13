<?php
/**
 * Reset password template file.
 * 
 * Required variables:
 * 
 * 
 */
?>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id' => 'password-reset-form',
	'type' => 'vertical',
))?>


<?php echo $form->textFieldRow($model, 'email')?>

<div class="actions">
	<?php echo CHtml::submitButton(Yii::t('view', 'Send mail'), array('class'=>'btn')); ?>
</div>

<?php $this->endWidget()?>
