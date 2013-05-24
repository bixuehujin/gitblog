<?php
/**
 * History revision view template file.
 * 
 * @var Post $post
 * @var PostRevision $revision
 */
?>
<?php 
Yii::app()->clientScript->registerPackage('bootstrap.plugins')
	->registerPackage('jquery.scrollTo')
	->registerScriptFile(Yii::app()->getBaseUrl(). '/js/post-view.js')
	->pregisterCssFile(__DIR__ . '/post.css');
?>
<div class="post">
	<div class="title">
		<h1><?php echo $revision->title?></h1>
		<div class="meta">
			<span class="tags">
				<?php foreach ($revision->attachedTags as $tag):?>
				<?php echo CHtml::link('#' . $tag->name, array('view/tag', 'id' => $tag->tid))?>
				<?php endforeach;?>
			</span>
			<span class="author">
				<span><?php echo GitBlog::username($revision->creator)?>  &nbsp;•&nbsp;
				<span><?php echo $revision->formattedCreated?></span></span>
			</span>
		</div>
	</div>
	<?php if ($post->rid != $revision->rid):?>
	<div class="alert alert-info">
		<span>您正在查看 <?php echo $revision->formattedCreated ?> 创建的历史版本。</span>
		<span class="pull-right"><?php echo CHtml::link('查看最新版', array('post/view', 'id' => $post->pid))?></span>
	</div>
	<?php endif;?>
	<div class="summary">
		<?php //echo $post->summary?>
	</div>
	
	<div class="content">
		<?php echo $revision->formattedContent;?>
	</div>
</div>
