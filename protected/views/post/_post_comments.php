<?php
/**
 * $comments: array of comment object.
 * $post: the post obejct comments attached.
 */
?>
<div class="comments">
	<legend>评论列表 (<?php echo $post->num_comments?>)</legend>
	<?php foreach ($comments as $comment):?>
	
		<?php echo $this->renderPartial('_post_comment', array('comment'=>$comment))?>
		
	<?php endforeach;?>	
</div>
