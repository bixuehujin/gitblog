<?php
/**
 * User feed home template file.
 * 
 * @var CActiveDataProvider $provider
 */
?>


<div class="tabable">
	<?php $this->widget('bootstrap.widgets.TbMenu', array(
		'items' => array(
			array('label' => '收到的评论', 'url' => array('user/comments', 'type' => 'received')),
			array('label' => '发出的评论', 'url' => array('user/comments', 'type' => 'sent'))
		),
		'htmlOptions' => array(
			'class' => 'nav nav-tabs'
		)
	))?>
	<div class="tab-content">
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	
	</div>
</div>
