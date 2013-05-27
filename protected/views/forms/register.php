<?php
/**
 * Register form template file.
 * 
 * @var RegisterForm $model
 */
?>
<?php 
?>
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id' => 'register-form',
	'type' => 'horizontal',
))?>

<?php echo $form->textFieldRow($model, 'username')?>

<?php echo $form->textFieldRow($model, 'email')?>

<?php echo $form->passwordFieldRow($model, 'password')?>

<div class="control-group">
	<div class="controls">
		<?php echo CHtml::submitButton('注册', array('class' => 'btn btn-primary'))?>
	</div>
</div>

<?php $this->endWidget()?>
