<?php

?>
<div class="row">
	<div class="span12">
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
		<legend>全局设置</legend>
		
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
			<div class="controls">
				<?php echo CHtml::submitButton('保存', array('class'=>'btn')); ?>
			</div>
		</div>
			
		</section>
		
		
		<?php $this->endWidget();?>
	</div>
</div>