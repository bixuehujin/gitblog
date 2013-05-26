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
					回复我的评论: 
					<?php echo CHtml::link($comment->getParentObject()->content, array('post/view', 'id' => $comment->ownerObject->pid))?>
				<?php else:?>
					评论我的文章: 
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
