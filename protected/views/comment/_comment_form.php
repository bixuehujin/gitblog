<?php
/**
 * comment form.
 * $commentForm: object 
 * $post: the post object.
 */
?>
<a name="comment-form"></a>
<?php 
	$form = $this->beginWidget('CActiveForm', array(
		'id'=>'comment-form',
		//'action' => array('comment/create'),
		'enableClientValidation' => true,
		'clientOptions' => array(
			'validateOnSubmit' => true
		),
		'htmlOptions' => array(
			'class'=>'form-horizontal',
		)
	))
?>

<legend>发表评论</legend>
		<?php echo Yii::app()->sessionMessager->renderMessageWidget();?>
		<?php echo CHtml::errorSummary($commentForm, '表单提交发生错误，请检查：', null, array('class'=>'alert alert-error'))?>
<section>
	<?php echo $form->hiddenField($commentForm, 'post_id', array('value'=>$post->post_id))?>
	<?php echo $form->hiddenField($commentForm, 'comment_ref', array('value'=>0))?>
	
	<div class="control-group">
		<?php echo $form->labelEx($commentForm, 'content', array('class'=>'control-label'))?>
		<div class="controls">
			<?php echo $form->textArea($commentForm, 'content')?>
		</div>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($commentForm, 'author', array('class'=>'control-label'))?>
		<div class="controls">
			<?php echo $form->textField($commentForm, 'author')?>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo $form->labelEx($commentForm, 'email', array('class'=>'control-label'))?>
		<div class="controls">
			<?php echo $form->textField($commentForm, 'email')?>
		</div>
	</div>
	
	<div class="control-group">
		<?php echo $form->labelEx($commentForm, 'website', array('class'=>'control-label'))?>
		<div class="controls">
			<?php echo $form->textField($commentForm, 'website')?>
		</div>
	</div>
	
	<div class="control-group">
		<div class="controls">
			<?php echo CHtml::submitButton('提交评论', array('class'=>'btn btn-primary'))?>
		</div>
	</div>
	
</section>
	

<?php $this->endWidget();?>