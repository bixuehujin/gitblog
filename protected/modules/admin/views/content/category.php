<?php
Yii::app()->clientScript->registerPackage('bootstrap.plugins')
	->registerScriptFile(Yii::app()->getBaseUrl() . '/js/admin.content.js');
?>

<div class="tabable">
	<ul class="nav nav-tabs" id="myTab">
		<li><a href="#aaa" data-toggle="tab"><?php echo Yii::t('admin', 'Category List')?></a></li>
		<li><a href="#ccc" data-toggle="tab"><?php echo Yii::t('admin', 'Category List')?></a></li>
		<li><a href="#bbb" data-toggle="tab"><?php echo Yii::t('admin', 'Category List')?></a></li>
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
					Yii::t('admin', 'category_id::Category ID'),
					Yii::t('admin', 'name::Category Name'),
					Yii::t('admin', 'description::Description'),
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

