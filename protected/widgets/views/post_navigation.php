<?php 
/**
 * PostNavigation widget template file.
 */
?>

<div class="navigation widget" id="widget-post-navigation">
	<div class="widget-title">目录</div>
	<div class="widget-content">
		<?php $this->widget('CMenu', array(
			'items' => $items,
			'htmlOptions' => $this->topmenuOptions,
		))?>
	</div>
	<div class="widget-footer">
		<a title="显示文章目录" href="javascript:;" id="trigger" class="icon-arrow-left"></a>
	</div>
</div>
