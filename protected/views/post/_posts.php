<?php
/**
 * Post list template file.
 * 
 * @var Controller $this 
 * @var CActiveDataProvider $provider
 */
?>

<?php 
Yii::app()->clientScript->pregisterCssFile(__DIR__ . '/posts.css');
?>

<div class="posts">
	<?php foreach($provider->getData() as $post):?>
	<div class="post clearfix">
		<div class="user">
			<?php echo GitBlog::userAvatarLink($post->getAuthor())?>
		</div>
		<div class="content">
			<h2><?php echo CHtml::link($post->title, array('post/view', 'id' => $post->pid))?></h2>
			<div class="summary">
				<?php echo ($post->getAbstract())?>
			</div>
			<div class="meta">
				<span class="tags">
					<?php foreach ($post->attachedTags as $tag):?>
					<?php echo CHtml::link('#' . $tag->name, array('view/tag', 'id' => $tag->tid))?>
					<?php endforeach;?>
				</span>
				<span class="author">
					<span><?php echo GitBlog::username($post->getAuthor())?>  •
					<span><?php echo $post->formattedCreated?></span></span>
				</span>
				<span class="read pull-right">
					<?php echo CHtml::link(Yii::t('view', 'show all'), array('post/view', 'id' => $post->pid))?>
				</span>
			</div>
		</div>
	</div>
	<?php endforeach;?>
</div>
