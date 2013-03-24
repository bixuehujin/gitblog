<?php
Yii::app()->clientScript->registerPackage('bootstrap')
//->registerPackage('bootstrap.responsive')
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
<?php $layout = Yii::app()->getComponent('layout')?>


<?php if ($layout->hasHeader()):?>
	<?php $layout->renderHeader()?>
<?php endif;?>


<div class="container">
	
	<div class="row">
		<?php echo $content; ?>
	</div>
	
	
	<?php if ($layout->hasFooter()):?>
		<?php $layout->renderFooter()?>
	<?php endif;?>
</div>

</body>
</html>
