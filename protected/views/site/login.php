<?php
/**
 * Site login page template file.
 * 
 * @var LoginForm $model
 */
?>

	
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'login-form',
	'type' => 'horizontal',
)); ?>
		
<?php echo $form->textFieldRow($model, 'username')?>

<?php echo $form->passwordFieldRow($model, 'password')?>

<div class="control-group">
	<div class="controls">
		<label class="checkbox">
			<?php echo $form->checkBox($model,'rememberMe'); ?>
			记住登录状态
		</label>
		<?php echo CHtml::submitButton('登录', array('class'=>'btn btn-primary')); ?>
	</div>
</div>

<?php $this->endWidget(); ?>

