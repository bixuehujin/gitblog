<?php
/**
 * PostCommitter template file.
 */
?>
<?php 
Yii::app()->clientScript->pregisterCssFile(__DIR__ . '/post_committer.css');
?>
<div class="widget" id="widget-post-committer">
	<div class="widget-title">贡献者</div>
	<div class="widget-content">
		<?php foreach ($this->committers as $committer):?>
			<?php echo GitBlog::userAvatarLink($committer, 'small')?>
		<?php endforeach;?>
	</div>
</div>
