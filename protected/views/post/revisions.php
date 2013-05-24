<?php
/**
 * Post revision list template file.
 * 
 * @var PostController $this
 * @var Post $post
 * @var PostRevision[] $revisions
 */
?>
<?php 
Yii::app()->clientScript->pregisterCssFile(__DIR__ . '/revisions.css');
?>

<div class="revisions">
<?php foreach ($revisions as $key => $revision):?>
	
	<div class="revision clearfix">
		<div class="committer pull-left">
			<?php echo GitBlog::userAvatarLink($revision->creator)?>
		</div>
		<div class="commit pull-right">
			<div class="commit-header">
				<span><?php echo CHtml::link($revision->title, array('/post/view', 'id' => $revision->post_id, 'rid' => $revision->rid))?></span>
				<span class="version pull-right"><?php echo '#' . ($key + 1)?></span>
			</div>
			<div class="commit-content">
				<?php echo $revision->commit?>
			</div>
			<div class="commit-footer">
				<?php echo GitBlog::username($revision->creator)?> • <span class="date"><?php echo $revision->formattedCreated?></span>
			</div>
		</div>
	</div>
	
<?php endforeach;?>
</div>
