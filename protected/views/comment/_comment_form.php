<?php
/**
 * comment form.
 * $commentForm: object 
 * $post: the post object.
 */
?>

<?php 
	$form = $this->beginWidget('ext.bootstrap.widgets.TbActiveForm', array(
		'id' => 'comment-form',
		'type' => 'inline',
		'action' => array('/post/view', 'id'=>$post->pid, '#'=>'comment-form'),
		'enableClientValidation' => true,
		'clientOptions' => array(
			'validateOnSubmit' => true
		),
	))
?>

<legend>发表评论

</legend>

	<?php echo Yii::app()->console->render();?>
<section class="clearfix">
	<?php echo $form->hiddenField($commentForm, 'parent', array('id' => 'parent'))?>
	
	<?php if ($commentForm->isAnonymousScenario()):?>
	<div>
		<?php echo $form->textFieldRow($commentForm, 'author', array('id' => 'author'))?>
		<?php echo $form->textFieldRow($commentForm, 'email', array('id' => 'email'))?>
		<?php echo $form->textFieldRow($commentForm, 'website', array('id' => 'website'))?>
	</div>
	<?php endif;?>
	
	<div>
	<?php echo $form->textAreaRow($commentForm, 'content')?>
	</div>
	<div>
	<?php echo CHtml::submitButton('提交评论', array('class'=>'btn btn-primary pull-right'))?>
	</div>
	
</section>
	

<?php $this->endWidget();?>
