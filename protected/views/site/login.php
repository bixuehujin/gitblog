<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - 登录';
$this->breadcrumbs=array(
	'Login',
);
?>

<div class="span6">
	
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'login-form',
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
		'htmlOptions'=>array('class'=>'form-horizontal')
	)); ?>
		
		<legend>登录</legend>
		<div class="control-group">
			<?php echo $form->labelEx($model,'username', array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'username'); ?>
				<?php echo $form->error($model, 'username')?>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->labelEx($model,'password', array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->passwordField($model,'password'); ?>
			</div>
		</div>


		<div class="control-group">
			<div class="controls">
				<label class="checkbox">
					<?php echo $form->checkBox($model,'rememberMe'); ?>
					记住登录状态
				</label>
				<?php echo CHtml::submitButton('登录', array('class'=>'btn')); ?>
			</div>
		</div>
<!-- 
		<div class="row">
			<?php echo $form->labelEx($model,'username'); ?>
			<?php echo $form->textField($model,'username'); ?>
			<?php echo $form->error($model,'username'); ?>
		</div>
	
		<div class="row">
			<?php echo $form->labelEx($model,'password'); ?>
			<?php echo $form->passwordField($model,'password'); ?>
			<?php echo $form->error($model,'password'); ?>
			<p class="hint">
				Hint: You may login with <kbd>demo</kbd>/<kbd>demo</kbd> or <kbd>admin</kbd>/<kbd>admin</kbd>.
			</p>
		</div>
		
		
	
		<div class="row rememberMe">
			<?php echo $form->checkBox($model,'rememberMe'); ?>
			<?php echo $form->label($model,'rememberMe'); ?>
			<?php echo $form->error($model,'rememberMe'); ?>
		</div>
	
		<div class="row buttons">
			<?php echo CHtml::submitButton('Login'); ?>
		</div>
 -->
	<?php $this->endWidget(); ?>
	</div><!-- form -->

