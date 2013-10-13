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
	<div class="widget-title"><?php echo Yii::t('view', 'About Tag')?></div>
	<div class="widget-content">
		<h3 class="name">
			<?php echo CHtml::link($this->name, array('/view/tag', 'id' => $this->tagId))?> 
			<em><?php echo Yii::t('view', '{count} posts attached', array('{count}' => $this->attachedCount))?></em>
		</h3>
		<p class="description"><?php echo $this->description?></p>
	</div>
</div>
