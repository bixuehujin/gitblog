<?php
/**
 * RoleForm template file.
 * 
 * @var MemberController $this
 * @var RoleForm $model
 */
?>


<?php 

Yii::import('bootstrap.widgets.TbActiveForm');

$form = $this->beginWidget('ActiveForm', array(
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
				<?php echo CHtml::submitButton(Yii::t('admin', 'Submit'), array('class'=>'btn btn-primary'))?>
				<?php echo CHtml::resetButton(Yii::t('admin', 'Reset'), array('class'=>'btn'))?>
			<?php elseif ($model->scenario == RoleForm::SCENARIO_MODIFY):?>
				<?php echo CHtml::submitButton(Yii::t('admin', 'Save'), array('class'=>'btn btn-primary'))?>
				<?php echo CHtml::resetButton(Yii::t('admin', 'Reset'), array('class'=>'btn'))?>
			<?php else:?>
				<?php echo CHtml::submitButton(Yii::t('admin', 'Delete'), array('class'=>'btn btn-primary'))?>
				<?php echo CHtml::resetButton(Yii::t('admin', 'Cancel'), array('class'=>'btn'))?>
			<?php endif;?>
		</div>
	</div>
</section>


<?php $this->endWidget();?>


