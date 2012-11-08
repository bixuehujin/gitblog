<?php
?>

<?php 
	$form = $this->beginWidget('CActiveForm', array(
		'id' => 'user-form',
		'htmlOptions' => array('class'=>'form-horizontal'),
		'clientOptions'=>array(
				'validateOnSubmit'=>true,
		),
		'enableClientValidation'=>true,
	));
?>

<legend>用户信息</legend>

<?php echo Yii::app()->sessionMessager->renderMessageWidget();?>

<section>
	<div class="control-group">
		<?php echo $form->labelEx($userModel, 'username', array('class'=>'control-label'));?>
		<div class="controls">
			<?php echo $form->textField($userModel, 'username')?>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo $form->labelEx($userModel, 'truename', array('class'=>'control-label'));?>
		<div class="controls">
			<?php echo $form->textField($userModel, 'truename')?>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo $form->labelEx($userModel, 'gender', array('class'=>'control-label'))?>
		<div class="controls">
			<?php echo $form->radioButtonList($userModel, 'gender', array('m'=>'男', 'f'=>'女'), array(
				'separator'=>''		
			))?>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo $form->labelEx($userModel, 'email', array('class'=>'control-label'));?>
		<div class="controls">
			<?php echo $form->textField($userModel, 'email')?>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo $form->labelEx($userModel, 'weibo', array('class'=>'control-label'));?>
		<div class="controls">
			<?php echo $form->textField($userModel, 'weibo')?>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo $form->labelEx($userModel, 'github', array('class'=>'control-label'));?>
		<div class="controls">
			<?php echo $form->textField($userModel, 'github')?>
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
