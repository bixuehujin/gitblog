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

<?php echo $form->errorSummary($model)?>

<section>
	
	<?php echo $form->hiddenField($model, 'uid')?>
	
	<?php echo $form->textFieldRow($model, 'username')?>
	
	<?php echo $form->textFieldRow($model, 'email')?>
	
	<?php echo $form->passwordFieldRow($model, 'password')?>
	
	<?php echo $form->passwordFieldRow($model, 'password2')?>
	
	<?php echo $form->textFieldRow($model, 'truename')?>
	
	<?php echo $form->radioButtonListRow($model, 'gender', array('m'=>'Male', 'f'=>'Female'))?>
	
	<?php echo $form->textFieldRow($model, 'github')?>
	
	<?php echo $form->textFieldRow($model, 'weibo')?>
	
	<div class="control-group">
		<div class="controls">
			<?php echo CHtml::submitButton(
					Yii::t('admin', $model->scenarioIsCreation ? 'Submit' : 'Save'), 
					array('class'=>'btn btn-primary'))
			?>
			<?php echo CHtml::resetButton(
					Yii::t('admin', 'Reset'), 
					array('class'=>'btn'))
			?>
		</div>
	</div>
	
</section>

<?php $this->endWidget()?>
