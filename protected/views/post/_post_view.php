<div class="post">
	<div class="title">
		<h1><?php echo $post->title?></h1>
	</div>
	<div class="summary">
		<?php //echo $post->summary?>
	</div>
	
	<div class="content">
		<?php echo $post->content->body;?>
	</div>
</div>