<?php
/**
 * @var $this Controller
 * @var $post Post object
 */
?>

<div class="post">
	<div class="post-head">
		<?php echo CHtml::link($post->getAuthor()->username, array('/view/user', 'id'=>$post->getAuthor()->uid))?>
		<span class="pull-right date">
			<?php echo $post->getFormattedDate();?>
		</span>
	</div>
	<h2>
		<?php echo CHtml::link($post->title, array('/post/view', 'id'=>$post->pid))?>
	</h2>
	
	<div class="summary">
	<?php echo $post->getAbstract();?>
	<?php echo CHtml::link('查看全文', array('/post/view', 'id'=>$post->pid));?>
	</div>
	<div class="post-bottom clearfix">
		<?php $this->widget('application.widgets.TagWidget', array(
				'tags'=>$post->attachedTags,
				'prefix'=>'#'
			));
		?>
		<div class="links">
			<?php echo CHtml::link("评论({$post->comments})", array('/view/comments', 'id'=>$post->pid))?>
			<?php echo CHtml::link('查看全文', array('/post/view', 'id'=>$post->pid));?>
		</div>
	</div>
</div>
