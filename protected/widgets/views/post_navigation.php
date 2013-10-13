<?php 
/**
 * PostNavigation widget template file.
 */
?>

<div class="navigation widget" id="widget-post-navigation">
	<div class="widget-title"><?php echo Yii::t('view', 'Outline')?></div>
	<div class="widget-content">
		<?php $this->widget('CMenu', array(
			'items' => $items,
			'htmlOptions' => $this->topmenuOptions,
		))?>
	</div>
	<div class="widget-footer">
		<a title="<?php echo Yii::t('view', 'Show outline')?>" href="javascript:;" id="trigger" class="icon-arrow-left"></a>
	</div>
</div>
