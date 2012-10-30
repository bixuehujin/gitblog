<?php
/**
 * $comment: comment object.
 */
?>

<div class="comment">
	<div class="meta">
		<?php echo CHtml::link($comment->author, $comment->website)?>
		<?php echo $comment->getFormattedDate()?>
	</div>
	<div class="content">
		<?php echo $comment->content;?>
	</div>
</div>