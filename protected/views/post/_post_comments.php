<?php
/**
 * $comments: array of comment object.
 */
?>
<div class="comments">
	
	<?php foreach ($comments as $comment):?>
	
		<?php echo $this->renderPartial('_post_comment', array('comment'=>$comment))?>
		
	<?php endforeach;?>	
</div>
