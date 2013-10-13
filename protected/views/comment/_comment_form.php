<?php
/**
 * Comment form.
 * 
 * @var CommentForm $model
 * @var string $ownerType
 */
?>
<?php 
if (!isset($ownerType)) {
	$ownerType = Yii::t('view', 'Comment');
}
?>


<?php 
	$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id' => 'comment-form',
		'type' => 'inline',
		'action' => '#comment-form',
		'enableClientValidation' => true,
		'clientOptions' => array(
			'validateOnSubmit' => true
		),
	))
?>

<legend><?php echo Yii::t('view', $ownerType) ?></legend>

	<?php echo Yii::app()->console->render();?>
<section class="clearfix">
	<?php echo $form->hiddenField($model, 'parent', array('id' => 'parent'))?>
	
	<?php if ($model->isAnonymousScenario()):?>
	<div>
		<?php echo $form->textFieldRow($model, 'author', array('id' => 'author'))?>
		<?php echo $form->textFieldRow($model, 'email', array('id' => 'email'))?>
		<?php echo $form->textFieldRow($model, 'website', array('id' => 'website'))?>
	</div>
	<?php endif;?>
	
	<div>
	<?php echo $form->textAreaRow($model, 'content')?>
	</div>
	<div>
	<?php echo CHtml::submitButton(Yii::t('view', 'Submit ') . $ownerType, array('class'=>'btn btn-primary pull-right'))?>
	</div>
	
</section>
<?php $this->endWidget();?>
