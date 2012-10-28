<?php 
Yii::app()->clientScript->registerPackage('bootstrap')
	->registerPackage('bootstrap.responsive');
Yii::app()->clientScript->registerCssFile(Yii::app()->getBaseUrl() . '/css/admin.main.css');
?>
<!DOCTYPE html>
<html lang="zh">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="zh" />
	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="nav-collapse collapse">
				<?php $this->widget('zii.widgets.CMenu', array(
					'htmlOptions' => array('class'=>'nav'),
					'items' => array(
						array('label'=>'首页', 'url'=>array('/admin/index')),
						array('label'=>'用户信息', 'url'=>array('/admin/user')),
						array('label'=>'全局设置', 'url'=>array('/admin/global')),
						array('label'=>'关于', 'url'=>array('/admin/about')),
						array('label'=>'返回前台', 'url'=>array('/site/index')),
					),
				))?>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="span12">
				<?php echo Yii::app()->sessionMessager->renderMessageWidget();?>
			</div>
		</div>
			<?php
		echo $content;
	?>
	</div>

<div class="container">

</div>
</body>
</html>