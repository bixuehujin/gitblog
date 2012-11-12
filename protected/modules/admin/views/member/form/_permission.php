<?php
/**
 * Roles permissions management template file.
 * 
 * @var MemberController $this
 * @var FormModel $model
 * @var CArrayDataProvider $dataProvider
 * @var array $columns columns used to render for TbGridView
 */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'permission-form',
))?>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
	'dataProvider'=>$dataProvider,
	'columns'=>$columns,
));
?>

<?php 
	echo $form->errorSummary($model);
?>

<div class="control-group">
	<div class="controls pull-right">
	<?php 
		echo CHtml::resetButton('重置', array('class'=>'btn'));
		echo CHtml::submitButton('保存', array('class'=>'btn btn-primary'));
	?>
	</div>
</div>

<?php $this->endWidget();?>
