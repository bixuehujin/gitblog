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
			array('label' => Yii::t('view', 'Comments received'), 'url' => array('user/comments'), 'active' => $type === 'received'),
			array('label' => Yii::t('view', 'Comments sent'), 'url' => array('user/comments', 'type' => 'sent'))
		),
		'htmlOptions' => array(
			'class' => 'nav nav-tabs'
		)
	))?>
	<div class="tab-content inner">
	<?php $this->renderPartial('_comments_' . $type, array('provider' => $provider))?>
	</div>
</div>
