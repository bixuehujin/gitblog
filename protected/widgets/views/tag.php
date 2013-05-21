<?php
/**
 * tag template used by posts list.
 * $this TagWidget
 * $tags: array of tag object.
 * $htmlOptions array
 */
?>

<?php if (!empty($tags)):?>
	<div class="tags <?php echo $this->classes ?>">
		<span>标签：</span>
		<?php foreach ($tags as $tag):?>
			<?php echo CHtml::link($tag->name, array('/view/tag', 'id'=>$tag->tid))?>
		<?php endforeach;?>
	</div>
<?php endif;?>