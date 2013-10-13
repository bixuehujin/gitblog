<?php
/**
 * User login form template file.
 * 
 * @var LoginForm $model
 */
?>


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'login-form',
	'type' => 'horizontal',
)); ?>

<section class="fields">

<?php echo $form->textFieldRow($model, 'username')?>

<div class="control-group">
	<?php echo $form->labelEx($model, 'password', array('class' => 'control-label'))?>
	<div class="controls">
		<?php echo $form->passwordField($model, 'password')?>
		<?php echo $form->error($model, 'password')?>
		<?php echo CHtml::link(Yii::t('view', 'Forgot password?'), array('site/reset'))?>
	</div>
</div>
</section>
<div class="control-group buttons">
	<div class="controls">
		<label class="checkbox">
			<?php echo $form->checkBox($model,'rememberMe'); ?>
			<?php echo Yii::t('view', 'Remember Me')?>
		</label>
		<?php echo CHtml::submitButton(Yii::t('view', 'Login'), array('class'=>'btn btn-primary')); ?>
	</div>
</div>

<?php $this->endWidget(); ?>
