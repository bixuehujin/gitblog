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

<div class="account-menu">
<?php $this->widget('bootstrap.widgets.TbMenu', array(
	'items' => array(
		array('label' => '基本信息', 'url' => array('/account/info')),
		array('label' => '头像设置', 'url' => array('/account/avatar')),
		array('label' => '密码修改', 'url' => array('/account/password')),
		array('label' => '内容设定', 'url' => array('/account/content')),
	),
	'type' => 'list'
))?>
</div>
