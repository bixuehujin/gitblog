<?php

?>
<div class="row">
	<div class="span3">
		<?php echo $this->renderPartial('_menu');?>		
	</div>
	
	<div class="span9">
		
		<?php echo Yii::app()->sessionMessager->renderMessageWidget();?>
		
		<?php 
			$form = $this->beginWidget('CActiveForm', array(
				'id'=>'global-form',
				'enableClientValidation'=>true,
				'clientOptions'=>array(
						'validateOnSubmit'=>true,
				),
				'htmlOptions'=>array('class'=>'form-horizontal')
			));
		?>
		<section>
			<div class="control-group">
				<?php echo $form->labelEx($model, 'site_name', array('class'=>'control-label'))?>
				<div class="controls">
					<?php echo $form->textField($model, 'site_name');?>
				</div>
			</div>
			
			<div class="control-group">
				<?php echo $form->labelEx($model, 'site_desp', array('class'=>'control-label'))?>
				<div class="controls">
					<?php echo $form->textArea($model, 'site_desp')?>
				</div>
			</div>
			
			<div class="control-group">
				<?php echo $form->labelEx($model, 'site_slogan', array('class'=>'control-label'))?>
				<div class="controls">
					<?php echo $form->textArea($model, 'site_slogan')?>
				</div>
			</div>
			
			<div class="control-group">
				<?php echo $form->labelEx($model, 'site_email', array('class'=>'control-label'))?>
				<div class="controls">
					<?php echo $form->textField($model, 'site_email')?>
				</div>
			</div>
			
			<div class="control-group">
				<div class="controls">
					<?php echo CHtml::submitButton('保存', array('class'=>'btn btn-primary')); ?>
					<?php echo CHtml::resetButton('重置', array('class'=>'btn')); ?>
				</div>
			</div>
			
		</section>
		
		
		<?php $this->endWidget();?>
	</div>
</div>