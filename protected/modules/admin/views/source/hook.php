<?php 
/**
 * $model SourceHookFrom
 * $this Controller
 */
?>

<?php
$labelOptions = array('class'=>'control-label');
?>



<?php 
	$form = $this->beginWidget('CActiveForm', array(
		'id'=>'hook-form',
		'htmlOptions'=>array('class'=>'form-horizontal'),
	));
?>

<legend>Github Hook</legend>
<?php echo Yii::app()->console->render();?>

<div class="control-group">
	<?php echo $form->LabelEx($model, 'url', array('class'=>'control-label'))?>
	<div class="controls">
		<?php echo $form->textField($model, 'url')?>
	</div>
</div>

<div class="control-group">
	<div class="controls">
		<?php echo Chtml::submitButton('重置Token', array('class'=>'btn btn-primary'))?>
	</div>
</div>


<?php
	$this->endWidget();
?>
