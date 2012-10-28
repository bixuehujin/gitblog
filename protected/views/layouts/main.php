<?php
Yii::app()->clientScript->registerPackage('bootstrap')
->registerPackage('bootstrap.responsive');
?>
<!DOCTYPE html>
<html lang="zh">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="zh" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container">
	<div class="row">
		<div class="navbar navbar-inverse">
			<div class="navbar-inner">
				<a class="brand" href="<?php ?>">博客主页</a>
				<div class="nav-collapse collapse">
					<?php $this->widget('zii.widgets.CMenu',array(
						'htmlOptions' => array('class'=>'nav'),
						'items'=>array(
							array('label'=>'主页', 'url'=>array('/site/index')),
							array('label'=>'关于', 'url'=>array('/site/page', 'view'=>'about')),
							array('label'=>'联系', 'url'=>array('/site/contact')),
							array('label'=>'登录', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
							array('label'=>'退出 ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
							array('label'=>'后台管理', 'url'=>array('/admin/index'), 'visible'=>!Yii::app()->user->isGuest)
						),
					)); 
					?>		
				</div>
			</div>
		</div>
	</div>
</div>


<div class="container">
	<div class="row">
		<?php if(isset($this->breadcrumbs)):?>
			<?php $this->widget('zii.widgets.CBreadcrumbs', array(
				'tagName' => 'ul',
				'links'=>$this->breadcrumbs,
				'htmlOptions'=>array('class'=>'breadcrumb'),
				'activeLinkTemplate'=>'<li><a href="{url}">{label}</a></li>'
			)); ?><!-- breadcrumbs -->
		<?php endif?>
	</div>
	
	
	<div class="row">
		<?php echo $content; ?>
	</div>
	
	<footer>
		<p>Copyright &copy; <?php echo date('Y'); ?> by My Company.</p>
	</footer>
</div>

</body>
</html>
