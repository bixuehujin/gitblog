<?php
/**
 * Menu template for user feed page.
 * 
 */
?>
<?php 
$isSelf = $user->isSelf();
$items = array(
	array('label' => '文章', 'url' => array('/user/articles')),
	array('label' => '专题', 'url' => array('/user/topics')),
	array('label' => '评论', 'url' => array('/user/comments', 'type' => 'received'), 'visible' => $isSelf),
	array('label' => '信息', 'url' => array('/user/info'), 'visible' => !$isSelf),
	array('label' => '留言', 'url' => array('/user/messages')),
);
$uid = Yii::app()->request->getQuery('id');
foreach ($items as &$item) {
	if ($isSelf) {
		$item['label'] = '我的' . $item['label'];
	}else {
		$item['url']['id'] = $uid;
		$item['label'] = '他的' . $item['label'];
	}
}
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
