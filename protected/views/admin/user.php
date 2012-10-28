<?php
?>
<div class="row">
<div class="span12">


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
			<?php echo $form->labelEx($model, 'username', array('class'=>'control-label'));?>
			<div class="controls">
				<?php echo $form->textField($model, 'username')?>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->labelEx($model, 'truename', array('class'=>'control-label'));?>
			<div class="controls">
				<?php echo $form->textField($model, 'truename')?>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->labelEx($model, 'gender', array('class'=>'control-label'))?>
			<div class="controls">
				<?php echo $form->radioButtonList($model, 'gender', array('m'=>'男', 'f'=>'女'), array(
					'separator'=>''		
				))?>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->labelEx($model, 'email', array('class'=>'control-label'));?>
			<div class="controls">
				<?php echo $form->textField($model, 'email')?>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->labelEx($model, 'weibo', array('class'=>'control-label'));?>
			<div class="controls">
				<?php echo $form->textField($model, 'weibo')?>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->labelEx($model, 'github', array('class'=>'control-label'));?>
			<div class="controls">
				<?php echo $form->textField($model, 'github')?>
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