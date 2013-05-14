<?php
/**
 * post publish form.
 * 
 * Required variables:
 * 
 * @var PostForm $model
 */
?>
<?php 
Yii::app()->getComponent('layout')->setState('section_title', '发表文章');
?>
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id' => 'post-form',
	'type' => 'vertical',
))?>

<?php echo $form->textFieldRow($model, 'path', array('id' => 'path'))?>

<?php echo $form->textAreaRow($model, 'content', array('id' => 'content'))?>

<?php echo $form->textAreaRow($model, 'commit', array('id' => 'commit'))?>

<div class="clearfix">
<?php echo CHtml::submitButton('提交', array('class' => 'btn btn-primary pull-right'))?>
</div>

<?php $this->endWidget()?>
