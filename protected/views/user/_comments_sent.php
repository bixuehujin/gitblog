<?php
/**
 * User sent comments template file.
 * 
 * @var CActiveDataProvider $provider
 */
?>

<div class="comments">
	<?php foreach ($provider->getData() as $comment):?>
	<div class="comment clearfix">
		<div class="user pull-left">
			<?php if ($comment->parent):?>
				<?php echo $comment->getParentObject()->avatarLink()?>
			<?php else:?>
				<?php echo GitBlog::userAvatarLink($comment->getOwnerObject()->author)?>
			<?php endif;?>
		</div>
		<div class="content pull-right">
			<div class="content-header">
				<?php echo $comment->content?>
			</div>
			<div class="content-body">
				<?php if ($comment->parent):?>
					<?php echo Yii::t('view', 'Reply to {author}:', array('{author}' => $comment->getParentObject()->content))?>
					<?php echo CHtml::link($comment->getParentObject()->content, array('post/view', 'id' => $comment->ownerObject->pid))?>
				<?php else:?>
					<?php echo Yii::t('view', 'Comment to {author}:', array('{author}' => GitBlog::username($comment->ownerObject->author)))?>
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
