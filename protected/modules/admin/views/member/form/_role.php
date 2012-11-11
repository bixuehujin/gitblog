<?php
/**
 * RoleForm template file.
 * 
 * @var MemberController $this
 * @var RoleForm $model
 * @var 
 */
?>


<?php 
Yii::import('bootstrap.widgets.TbActiveForm');

$form = $this->beginWidget('TbActiveForm', array(
	'id'=>'role-form',
	'type'=>TbActiveForm::TYPE_HORIZONTAL,
))
?>

<section>
	
	<?php echo $form->errorSummary($model);?>
	
	<div class="control-group">
			<?php echo $form->textFieldRow($model, 'name', array('disabled'=>$model->scenario === RoleForm::SCENARIO_DELETE))?>
	</div>
	
	<div class="control-group">
		<?php echo $form->textFieldRow($model, 'description')?>
	</div>
	
	<div class="control-group">
		<div class="controls">
			<?php if ($model->scenario == RoleForm::SCENARIO_CREATE):?>
				<?php echo CHtml::submitButton('提交', array('class'=>'btn btn-primary'))?>
				<?php echo CHtml::resetButton('重置', array('class'=>'btn'))?>
			<?php elseif ($model->scenario == RoleForm::SCENARIO_MODIFY):?>
				<?php echo CHtml::submitButton('保存', array('class'=>'btn btn-primary'))?>
				<?php echo CHtml::resetButton('重置', array('class'=>'btn'))?>
			<?php else:?>
				<?php echo CHtml::submitButton('删除', array('class'=>'btn btn-primary'))?>
				<?php echo CHtml::resetButton('取消', array('class'=>'btn'))?>
			<?php endif;?>
		</div>
	</div>
</section>


<?php $this->endWidget();?>


