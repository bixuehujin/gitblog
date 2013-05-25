<?php
/**
 * Tag widget template file.
 * 
 */
?>
<?php 
Yii::app()->clientScript->pregisterCssFile(__DIR__ . '/tag_show.css');
?>
<div class="widget" id="widget-tag-show">
	<div class="widget-title">标签信息</div>
	<div class="widget-content">
		<h3 class="name">
			<?php echo CHtml::link($this->name, array('/view/tag', 'id' => $this->tagId))?> <em><?php echo $this->attachedCount?>篇文章有此标签</em>
		</h3>
		<p class="description"><?php echo $this->description?></p>
	</div>
</div>
