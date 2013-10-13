<?php
/**
 * Account info form template file (views/forms/account_form.php).
 * 
 * Required variables:
 * 
 * @var AccountInfoForm  $model
 */
?>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id' => 'account-info-form',
	'type' => 'horizontal',
))?>

<?php echo $form->textFieldRow($model, 'username')?>
<?php echo $form->textFieldRow($model, 'email')?>
<?php echo $form->radioButtonListRow($model, 'gender', array('m' => Yii::t('view', 'Male'), 'f' => Yii::t('view', 'Female'), 'u' => Yii::t('view', 'Secret')))?>
<?php echo $form->textFieldRow($model, 'truename')?>
<?php echo $form->textFieldRow($model, 'github')?>
<?php echo $form->textFieldRow($model, 'weibo')?>

<div class="control-group">
	<div class="controls">
		<?php echo CHtml::submitButton(Yii::t('view', 'Save'), array('class' => 'btn btn-primary'))?>
	</div>
</div>

<?php $this->endWidget()?>
