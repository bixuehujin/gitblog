<?php
Yii::app()->clientScript->registerPackage('bootstrap')
->registerPackage('bootstrap.responsive')
->registerCssFile(Yii::app()->getBaseUrl() . '/css/main.css');
?>
<!DOCTYPE html>
<html lang="zh">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="zh" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<?php echo $this->renderPartial('/layouts/_menu');?>


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
