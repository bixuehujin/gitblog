<?php
/**
 * Default 3 column layout template.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 * @since 2013-04-10
 * @filesource
 */
?>
<?php Yii::app()->clientScript->pregisterCssFile(__DIR__ . '/column3.css')?>
<?php $this->beginContent('//layouts/classic'); ?>
<?php $layout = Yii::app()->getComponent('layout');?>

<?php if ($layout->hasColumnItems('left')):?>
	<div id="column-left">
	<?php $layout->renderColumn('left', array(
		'prefix'=>'<div class="column-item">',
		'suffix'=>'</div>',
	))?>
	</div>
<?php endif;?>

<div id="column-content">
	<?php if ($layout->hasState('section_title')):?>
		<div class="section-title">
			<h1><?php echo $layout->getState('section_title')?></h1>
		</div>
	<?php endif;?>
	<?php if ($layout->hasBreadcrumbs()):?>
		<div class="breadcrumns">
			<?php $layout->renderBreadcrumbs('ext.bootstrap.widgets.TbBreadcrumbs')?>
		</div>
	<?php endif;?>
	<?php if (Yii::app()->console->hasMessages):?>
	<div class="messages">
		<?php Yii::app()->console->render();?>
	</div>
	<?php endif;?>
	
	<?php echo $content?>
</div>

<?php if ($layout->hasColumnItems('right')):?>
	<div id="column-right">
	<?php $layout->renderColumn('right', array(
		'prefix'=>'<div class="column-item">',
		'suffix'=>'</div>',
	))?>
	</div>
<?php endif;?>

<?php $this->endContent();?>
