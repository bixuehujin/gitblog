<?php
/**
 * $model: SystemShowForm
 */
?>

<?php 
$form = $this->beginWidget('CActiveForm', array(
		'id'=>'system-show-form',
		'htmlOptions'=>array('class'=>'form-horizontal')
));
?>
<legend><?php echo Yii::t('admin', 'Content setting')?></legend>
<?php echo CHtml::errorSummary($model, null, null, array('class'=>'alert alert-error'))?>
<?php echo Yii::app()->sessionMessager->renderMessageWidget();?>

<section>
	<div class="control-group">
		<?php echo $form->labelEx($model, 'post_page_size', array('class'=>'control-label'));?>
		<div class="controls">
			<?php echo $form->textField($model, 'post_page_size');?>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo $form->labelEx($model, 'comment_page_size', array('class'=>'control-label'));?>
		<div class="controls">
			<?php echo $form->textField($model, 'comment_page_size');?>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo $form->labelEx($model, 'auto_abstract_generation', array('class'=>'control-label'));?>
		<div class="controls">
			<?php echo $form->radioButtonList(
					$model, 
					'auto_abstract_generation', 
					array('1'=>Yii::t('admin', 'Yes'), '0'=>Yii::t('admin', 'No')), 
					array('separator'=>'')
				)
			?>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo $form->labelEx($model, 'post_abstract_len', array('class'=>'control-label'));?>
		<div class="controls">
			<?php echo $form->textField($model, 'post_abstract_len');?>
		</div>
	</div>
	<div class="control-group">
		<div class="controls">
			<?php echo CHtml::submitButton(Yii::t('admin', 'Save'), array('class'=>'btn btn-primary'));?>
			<?php echo CHtml::resetButton(Yii::t('admin', 'Reset'), array('class'=>'btn'));?>
		</div>
	</div>
</section>

<?php $this->endWidget();?>
