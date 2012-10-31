<?php
Yii::app()->clientScript->registerPackage('bootstrap.plugins')
	->registerScriptFile(Yii::app()->getBaseUrl() . '/js/admin.content.js');
?>

<div class="tabable">
	<ul class="nav nav-tabs" id="myTab">
		<li><a href="#aaa" data-toggle="tab">分类列表</a></li>
		<li><a href="#ccc" data-toggle="tab">分类列表</a></li>
		<li><a href="#bbb" data-toggle="tab">分类列表</a></li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane" id="aaa">
			<?php $provider = new CActiveDataProvider('Category');?>
			<?php $this->widget('zii.widgets.grid.CGridView', array(
				'dataProvider'=>$provider,
				//'htmlOptions'=> array('class'=>'table'),
				//'cssFile' => '',
				'itemsCssClass' => 'table table-striped',
				//'hideHeader' => true,
				'columns' => array(
					'category_id::分类ID',
					'name::分类名称',
					'description::描述',
					array(
						'class' => 'CButtonColumn'
					)
				)
			))?>
		</div>
		<div class="tab-pane" id="bbb">bbb</div>
		<div class="tab-pane" id="ccc">ccc</div>
	</div>
</div>

