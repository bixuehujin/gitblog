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
<legend>Git设置</legend>
<?php echo Yii::app()->console->render();?>

<section>

	<?php echo $form->textFieldRow($model, 'git_base_path')?>

	<div class="control-group">
		<div class="controls">
			<?php echo CHtml::submitButton('保存', array('class'=>'btn btn-primary'));?>
			<?php echo CHtml::resetButton('重置', array('class'=>'btn'));?>
		</div>
	</div>
</section>

<?php $this->endWidget();?>
