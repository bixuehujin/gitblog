<?php
/**
 * Password change form template file.
 * 
 * @var PasswordForm $model
 */
?>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id' => 'password-form',
	'type' => 'horizontal',
))?>

<?php if ($model->scenario === PasswordForm::SCENARIO_CHANGE):?>
	<?php echo $form->passwordFieldRow($model, 'opassword')?>
<?php endif;?>

<?php echo $form->passwordFieldRow($model, 'npassword')?>

<?php echo $form->passwordFieldRow($model, 'npassword2')?>

<div class="control-group">
	<div class="controls">
		<?php echo CHtml::submitButton($model->buttonLabel, array('class' => 'btn btn-primary'))?>
	</div>
</div>

<?php $this->endWidget()?>
