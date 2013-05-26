<?php
/**
 * User home comments template file.
 * 
 * @var CActiveDataProvider $provider
 */
?>
<?php 
Yii::app()->clientScript->pregisterCssFile(__DIR__ . '/feed.css');
$type = Yii::app()->request->getQuery('type', 'received');
?>

<div class="tabable">
	<?php $this->widget('bootstrap.widgets.TbMenu', array(
		'items' => array(
			array('label' => '收到的评论', 'url' => array('user/comments'), 'active' => $type === 'received'),
			array('label' => '发出的评论', 'url' => array('user/comments', 'type' => 'sent'))
		),
		'htmlOptions' => array(
			'class' => 'nav nav-tabs'
		)
	))?>
	<div class="tab-content inner">
	<?php $this->renderPartial('_comments_' . $type, array('provider' => $provider))?>
	</div>
</div>
