<?php
/**
 * tag template used by posts list.
 * $tags: array of tag object.
 */
?>

<?php if (!empty($tags)):?>
	<div class="tags">
		<span>标签：</span>
		<?php foreach ($tags as $tag):?>
			<?php echo CHtml::link($tag->tag->name, array('/view/tag', 'id'=>$tag->tag->tag_id))?>
		<?php endforeach;?>
	</div>
<?php endif;?>