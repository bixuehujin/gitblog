<?php
/**
 * templete to render a comments list.
 * 
 * @var CActiveDataProvider $provider The DataProvider of comments objects.
 * @var bool $showAllLink whether show view-all link in title bar.
 * @var string $ownerType
 */
?>
<?php 
$ownerType = isset($ownerType) ? $ownerType : '评论';
$showReplyLink = isset($showReplyLink) ? $showReplyLink : true;
?>
<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/comments.js');
Yii::app()->clientScript->registerPackage('jquery.scrollTo')
	->pregisterCssFile(__DIR__ . '/comments.css');
?>

<div class="comments">
	<legend class="clearfix">
		<span class="title"><?php echo $ownerType?>列表 (<?php echo $provider->totalItemCount?>)</span>
		<?php
			if(isset($showAllLink) && $showAllLink) { 
				echo CHtml::link('查看全部', array('/view/comments', 'id'=>$post->pid), array('class'=>'view-all'));
			}
		?>
	</legend>
	
	<?php foreach ($provider->getData() as $comment):?>
	<div class="comment clearfix">
		<div class="author">
			<?php echo $comment->avatarLink('small'); ?>
		</div>
		<div class="content">
			<p>
				<?php echo CHtml::link($comment->author, $comment->website)?>: 
				<?php echo $comment->content;?>
			</p>
			<div class="links">
				<span class="date"><?php echo $comment->formattedDate?></span>
				<?php if ($showReplyLink):?>
					<?php echo CHtml::link('回复', '#comment-form', array('class'=>'reply', 'data-id'=>$comment->cid, 'data-author'=>$comment->author))?>
				<?php endif;?>
			</div>
		</div>
		
	</div>
	<?php endforeach;?>	
	<?php $this->renderPartial('/common/_pager', array('pagination'=>$provider->getPagination()));?>
</div>
