<?php
/**
 * User received comments template file.
 * 
 * @var CActiveDataProvider $provider
 */
?>

<div class="comments">
	<?php foreach ($provider->getData() as $comment):?>
	<div class="comment clearfix">
		<div class="user pull-left">
			<?php echo $comment->avatarLink()?>
		</div>
		<div class="content pull-right">
			<div class="content-header">
				<?php echo $comment->content?>
			</div>
			<div class="content-body">
				<?php if ($comment->parent):?>
					<?php echo Yii::t('view', 'Reply to me:')?> 
					<?php echo CHtml::link($comment->getParentObject()->content, array('post/view', 'id' => $comment->ownerObject->pid))?>
				<?php else:?>
					<?php echo Yii::t('view', 'Comment to me:')?>
					<?php echo CHtml::link($comment->getOwnerObject()->title, array('post/view', 'id' => $comment->ownerObject->pid))?>
				<?php endif;?>
			</div>
			<div class="content-footer">
				<?php echo $comment->formattedCreated?>
			</div>
		</div>
	</div>
	<?php endforeach;?>
	<?php $this->renderPartial('/common/_pager', array('pagination'=>$provider->getPagination()));?>
</div>
