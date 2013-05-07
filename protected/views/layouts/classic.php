<?php 
/**
 * Classic main layout template.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 * @since 2013-04-10
 * @filesource
 */
?>
<?php
Yii::app()->clientScript->registerPackage('bootstrap')
//->registerPackage('bootstrap.responsive')
//->registerCssFile(Yii::app()->getBaseUrl() . '/css/main.css');
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

<div id="page-swapper">
<?php if ($layout->hasHeader()):?>
	<?php $layout->renderHeader()?>
<?php endif;?>

<?php if ($layout->hasHeroUnits()):?>
	<div id="herounits">
	<?php $layout->renderHeroUnits(array(
		'prefix' => '<div class="herounit">',
		'suffix' => '</div>'
	))?>
	</div>
<?php endif;?>

<div class="container" id="page-content">
	<div id="page-content-inner">
		<?php echo $content; ?>
		<div class="clearfix"></div>
	</div>
</div>
<div id="page-push"></div>
</div>
<?php if ($layout->hasFooter()):?>
	<?php $layout->renderFooter()?>
<?php endif;?>
</body>
</html>
