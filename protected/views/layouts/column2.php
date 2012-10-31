<?php 
/**
 * @var $this Controller
 */
?>

<?php $this->beginContent('//layouts/main'); ?>

<div class="row">
	<div class="span9 content-swapper">
		<?php if(isset($this->breadcrumbs)):?>
			<?php $this->widget('zii.widgets.CBreadcrumbs', array(
				'tagName' => 'ul',
				'links'=>$this->breadcrumbs,
				'htmlOptions'=>array('class'=>'breadcrumb'),
				'activeLinkTemplate'=>'<li><a href="{url}">{label}</a></li>'
			)); ?><!-- breadcrumbs -->
		<?php endif?>
		<div class="content">
			<?php echo $content?>
		</div>
	</div>
	<div class="span3">
		<?php foreach($this->widgets as $name=>$options):?>
			<?php $this->widget($name, $options)?>
		<?php endforeach;?>
	</div>
</div>

<?php $this->endContent();?>
