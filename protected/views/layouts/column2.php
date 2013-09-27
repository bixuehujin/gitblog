<?php 
/**
 * @var $this Controller
 */
?>

<?php $this->beginContent('//layouts/main'); ?>
<?php $layout = Yii::app()->getComponent('layout')?>

<div class="row">
	<div class="span9 content-swapper">
		
		<?php if ($layout->hasBreadcrumbs()):?>
			<?php $layout->renderBreadcrumbs('bootstrap.widgets.TbBreadcrumbs', array(
				'tagName' => 'ul',
				'links' => $layout->getBreadcrumbs(),
				'activeLinkTemplate' => '<li><a href="{url}">{label}</a></li>',
			));?>
		<?php endif;?>
		
		<div class="content">
			<?php echo $content?>
		</div>
		
	</div>
	<div class="span3">
		<div class="sidebar-cloumn" data-spy="affix">
			<?php if ($layout->hasColumnItems('sidebar')):?>
				<?php $layout->renderColumn('sidebar', array(
					'prefix' => '<div class="cloumn-item">',
					'suffix' => '</div>',
				))?>
			<?php endif;?>
		</div>
	</div>
</div>

<?php $this->endContent();?>
