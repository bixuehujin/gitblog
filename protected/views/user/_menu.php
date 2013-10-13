<?php
/**
 * Menu template for user feed page.
 * 
 */
?>
<?php 
$isSelf = $user->isSelf();
$items = array(
	array('label' => Yii::t('view', 'Article'), 'url' => array('/user/articles')),
	array('label' => Yii::t('view', 'Topic'), 'url' => array('/user/topics')),
	array('label' => Yii::t('view', 'Comment'), 'url' => array('/user/comments'), 'visible' => $isSelf),
	array('label' => Yii::t('view', 'Profile'), 'url' => array('/user/info'), 'visible' => !$isSelf),
	array('label' => Yii::t('view', 'Message'), 'url' => array('/user/messages')),
);
$uid = Yii::app()->request->getQuery('id');
?>
<div class="widget">
	<div class="widget-content">
	<?php $this->widget('bootstrap.widgets.TbMenu', array(
		'type' => 'list',
		'stacked' => true,
		'items' => $items,
	))?>
	</div>
</div>
