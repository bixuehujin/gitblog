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
	
	<legend>用户信息</legend>
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
				<?php echo CHtml::submitButton('保存', array('class'=>'btn')); ?>
			</div>
		</div>
		
	</section>
	
	<?php $this->endWidget();?>

	
</div>
</div>