<?php 
/**
 * @var $this Controller
 */
?>

<div class="container">
	<div class="row">
		<div class="navbar navbar-inverse">
			<div class="navbar-inner">
				<a class="brand" href="<?php ?>">博客主页</a>
				<div class="nav-collapse collapse">
					<?php $this->widget('zii.widgets.CMenu',array(
						'htmlOptions' => array('class'=>'nav'),
						'items'=>$this->menu
					)); 
					?>		
				</div>
			</div>
		</div>
	</div>
</div>