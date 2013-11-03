<?php
/**
 * Sidebar template for user account setting pages.
 * 
 * Required variables:
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 * @since 2013-04-10 
 * @filesource
 */
?>

<div class="account-menu widget">
<div class="widget-content">
<?php $this->widget('bootstrap.widgets.TbMenu', array(
	'items' => array(
		array('label' => Yii::t('view', 'Profile'), 'url' => array('/account/info')),
		array('label' => Yii::t('view', 'Avatar'), 'url' => array('/account/avatar')),
		array('label' => Yii::t('view', 'Password'), 'url' => array('/account/password')),
		array('label' => Yii::t('view', 'Repository'), 'url' => array('/account/repository')),
	),
	'type' => 'list'
))?>
</div>
</div>
