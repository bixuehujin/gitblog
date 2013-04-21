<?php 
/**
 * @var $this Controller
 */
?>
<?php 
Yii::app()->clientScript->pregisterCssFile(__DIR__ . '/header.css')
?>
<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
		<div class="navbar-swapper container">
			<div class="span8 header-nav">
				<a class="brand" href="<?php echo Yii::app()->getBaseUrl() . '/' ?>">博客主页</a>
				<div class="nav-collapse collapse">
					<?php $this->widget('zii.widgets.CMenu',array(
						'htmlOptions' => array('class'=>'nav'),
						'items'=>$this->menu,
						'encodeLabel'=>false,
					)); 
					?>
				</div>
			</div>
			<div class="span4 header-links pulls-left">
				<?php $this->widget('zii.widgets.CMenu',array(
					'htmlOptions' => array('class'=>'nav pull-right'),
					'items'=>$this->userMenuItems(),
					'encodeLabel'=>false,
				)); 
				?>
			</div>
		</div>
	</div>
</div>
