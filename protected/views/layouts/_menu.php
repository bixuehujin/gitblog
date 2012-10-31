<?php 
	$model = Category::model();
	$list = $model->getList();
	$items [] = array('label'=>'主页', 'url'=>array('/'), 'active'=> !isset($_GET['r'])) ;
	foreach ($list as $item) {
		$items[] = array(
			'label' => $item->name,
			'url' => array('/view/category', 'id'=>$item->category_id),		
		);
	}
	
	$items[] = array('label'=>'联系', 'url'=>array('/site/contact'));
	$items[] = array('label'=>'登录', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest);
	$items[] = array('label'=>'退出 ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest);
	$items[] = array('label'=>'后台管理', 'url'=>array('/admin'), 'visible'=>!Yii::app()->user->isGuest);

?>
<div class="container">
	<div class="row">
		<div class="navbar navbar-inverse">
			<div class="navbar-inner">
				<a class="brand" href="<?php ?>">博客主页</a>
				<div class="nav-collapse collapse">
					<?php $this->widget('zii.widgets.CMenu',array(
						'htmlOptions' => array('class'=>'nav'),
						'items'=>$items
					)); 
					?>		
				</div>
			</div>
		</div>
	</div>
</div>