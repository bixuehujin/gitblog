<?php
/**
 * AccountForm template file used for account creation and modification.
 * 
 * Required variables:
 * @var AccountForm $model
 */
?>

<?php 
$form = $this->beginWidget('ActiveForm', array(
	'id'=>'account-form',
	'type'=>ActiveForm::TYPE_HORIZONTAL,
))
?>
<section>
	
	<?php echo $form->textFieldRow($model, 'username')?>
	
	<?php echo $form->textFieldRow($model, 'email')?>
	
	<?php echo $form->textFieldRow($model, 'truename')?>
	
	<?php echo $form->textFieldRow($model, 'gender')?>
	
	<?php echo $form->passwordFieldRow($model, 'password')?>
	
	<?php echo $form->passwordFieldRow($model, 'password2')?>
	
	<?php echo $form->textFieldRow($model, 'github')?>
	
	<?php echo $form->textFieldRow($model, 'weibo')?>
	
	<div class="control-group">
		<div class="controls">
			<?php echo CHtml::resetButton('Submit', array('class'=>'btn btn-primary'))?>
			<?php echo CHtml::resetButton('Reset', array('class'=>'btn'))?>
		</div>
	</div>
	
</section>

<?php $this->endWidget()?>
