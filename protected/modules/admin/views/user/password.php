<?php
?>
<div class="row">
<div class="span3">
	<?php echo $this->renderPartial('/common/_menu', array('items'=>$items));?>
</div>
<div class="span9">

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
		<legend>密码修改</legend>
		<div class="control-group">
			<?php echo $form->labelEx($pwdModel, 'password_old', array('class'=>'control-label'));?>
			<div class="controls">
				<?php echo $form->passwordField($pwdModel, 'password_old')?>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->labelEx($pwdModel, 'password_new', array('class'=>'control-label'));?>
			<div class="controls">
				<?php echo $form->passwordField($pwdModel, 'password_new')?>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->labelEx($pwdModel, 'password_new2', array('class'=>'control-label'));?>
			<div class="controls">
				<?php echo $form->passwordField($pwdModel, 'password_new2')?>
			</div>
		</div>
		
		<div class="control-group">
			<div class="controls">
				<?php echo CHtml::submitButton('保存', array('class'=>'btn')); ?>
			</div>
		</div>
		
	<?php $this->endWidget();?>


	
</div>
</div>