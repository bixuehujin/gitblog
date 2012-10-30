<?php

?>
<div class="post">
	<h2>
		<?php echo CHtml::link($post->title, array('/post/view', 'id'=>$post->post_id))?>
	</h2>
	<div class="info">
		<?php echo CHtml::link($post->user->username, array('/view/user', 'id'=>$post->user->uid));?> 发表于 <?php echo $post->getFormattedDate();?>
	</div>
	<div class="summary">
	<?php echo $post->summary;?>
	</div>
	<div class="view-all">
		<?php echo CHtml::link('查看全文', array('/post/view', 'id'=>$post->post_id));?>
	</div>
</div>
