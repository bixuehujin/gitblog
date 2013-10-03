<?php
/**
 * System git setting form template.
 * 
 * @var SystemGitForm $model
 */
?>

<?php 
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id' => 'system-git-form',
		'type' => 'horizontal',
));
?>
<legend><?php echo Yii::t('admin', 'Git setting')?></legend>
<?php echo Yii::app()->console->render();?>

<section>

	<?php echo $form->textFieldRow($model, 'git_base_path')?>

	<div class="control-group">
		<div class="controls">
			<?php echo CHtml::submitButton(Yii::t('admin', 'Save'), array('class'=>'btn btn-primary'));?>
			<?php echo CHtml::resetButton(Yii::t('admin', 'Reset'), array('class'=>'btn'));?>
		</div>
	</div>
</section>

<?php $this->endWidget();?>
