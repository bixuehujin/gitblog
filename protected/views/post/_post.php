<?php
/**
 * The post view template file.
 * 
 */
?>
<?php 
Yii::app()->clientScript->pregisterCssFile(__DIR__ . '/post.css');
?>


<div class="post">
	<div class="title">
		<h1><?php echo $post->title?></h1>
		<div class="meta">
			<span class="tags">
				<?php foreach ($post->attachedTags as $tag):?>
				<?php echo CHtml::link('#' . $tag->name, array('view/tag', 'id' => $tag->tid))?>
				<?php endforeach;?>
			</span>
			<span class="author">
				<span><?php echo GitBlog::username($post->getAuthor())?>  &nbsp;•&nbsp;
				<span><?php echo $post->formattedCreated?></span></span>
			</span>
		</div>
	</div>
	<div class="summary">
		<?php //echo $post->summary?>
	</div>
	
	<div class="content">
		<?php echo $post->content->formattedContent;?>
	</div>
</div>
