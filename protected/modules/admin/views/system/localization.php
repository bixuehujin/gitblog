<?php
/**
 * Administrator localization settings template file.
 */
?>
<?php echo Yii::app()->console->render();?>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id' => 'regional-form'
))?>

<?php echo $form->dropDownListRow($model, 'default_country', $model->getAllCountries())?>

<?php echo $form->dropDownListRow($model, 'default_timezone', $model->getAllTimezones())?>

<?php echo $form->dropDownListRow($model, 'default_language', $model->getAllLanguages())?>

<div class="control-group">
<div class="controls">
<?php echo CHtml::submitButton(Yii::t('admin', 'Save configuration'), array('class' => 'btn btn-primary'))?>
</div>
</div>

<?php $this->endWidget();?>
T