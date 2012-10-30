<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
		<div class="nav-collapse collapse">
			<?php $this->widget('zii.widgets.CMenu', array(
				'htmlOptions' => array('class'=>'nav'),
				'items' => array(
					array(
						'label'=>'首页', 
						'url'=>array('/admin'), 
						'active' => $_GET['r'] == 'admin'
					),
					array(
						'label'=>'用户信息', 
						'url'=>array('/admin/user'), 
						'active' => preg_match('/admin\/user.*/', $_GET['r'])
					),
					array(
						'label'=>'内容源', 
						'url'=>array('/admin/source'), 
						'active' => preg_match('/admin\/source.*/', $_GET['r'])
					),
					array(
						'label'=>'内容管理', 
						'url'=>array('/admin/content'), 
						'active' => preg_match('/admin\/content.*/', $_GET['r'])
					),
					array(
						'label'=>'系统设置', 
						'url'=>array('/admin/system'), 
						'active' => preg_match('/admin\/system.*/', $_GET['r'])
					),
					array(
						'label'=>'返回前台', 
						'url'=>array('/site/index')
					),
				),
			))?>
			
		</div>
	</div>
</div>
