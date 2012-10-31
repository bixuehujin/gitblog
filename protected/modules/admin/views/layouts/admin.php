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
	<?php echo $this->renderPartial('/layouts/_navbar');?>
	
	<div class="container-fluid">
		<?php
			echo $content;
		?>
	</div>

	<div class="container-fluid">
	
	</div>
</body>
</html>