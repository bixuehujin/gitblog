<?php
/**
 * @var $this Controller
 * @var $post Post object
 */
?>

<div class="post">
	<div class="post-head">
		<?php echo CHtml::link($post->user->username, array('/view/user', 'id'=>$post->user->uid))?>
		<span class="pull-right">
			<?php echo $post->getFormattedDate();?>
		</span>
	</div>
	<h2>
		<?php echo CHtml::link($post->title, array('/post/view', 'id'=>$post->post_id))?>
	</h2>
	
	<div class="summary">
	<?php echo $post->getAbstract();?>
	<?php echo CHtml::link('查看全文', array('/post/view', 'id'=>$post->post_id));?>
	</div>
	<div class="post-bottom clearfix">
		<?php $this->widget('application.widgets.TagWidget', array(
				'tags'=>$post->tags,
				'prefix'=>'#'
			))
		?>
		<div class="links">
			<?php echo CHtml::link("评论({$post->num_comments})", array('/view/comments', 'id'=>$post->post_id))?>
			<?php echo CHtml::link('查看全文', array('/post/view', 'id'=>$post->post_id));?>
		</div>
	</div>
</div>
