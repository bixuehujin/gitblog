<?php
/**
 * $comment: comment object.
 */
?>

<div class="comment">
	<div class="content">
		<?php echo CHtml::link($comment->author, $comment->website)?>: 
		<?php echo $comment->content;?>
	</div>
	<div class="links">
		<span class="date"><?php echo $comment->formattedDate?></span>
		<?php echo CHtml::link('回复', '#comment-form', array('class'=>'reply', 'data-id'=>$comment->comment_id, 'data-author'=>$comment->author))?>
	</div>
	
</div>