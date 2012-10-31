<?php
/**
 * $pagination: 
 */
?>
<div class="pager">
<?php 
	$this->widget('CLinkPager', array(
		'pages'=>$pagination,
		'header'=>'',
		'hiddenPageCssClass'=>'disabled',
		'cssFile'=>false,
		'selectedPageCssClass'=>'active'
	))
?>
</div>