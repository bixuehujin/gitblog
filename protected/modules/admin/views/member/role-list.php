<?php
/**
 * Member roles management template file.
 * 
 * @var MemberController $this
 * @var array $rolesProvider Array of role.
 * @var string $title 
 */
?>

<?php echo Yii::app()->console->render();?>

<?php 
$this->widget('bootstrap.widgets.TbGridView', array(
	'dataProvider'=>$rolesProvider,
	'columns'=>array(
		Yii::t('admin', 'name::Role name'),
		Yii::t('admin', 'description::Description'),
		array(
			'class' => 'bootstrap.widgets.TbButtonColumn',
			'template'=>'{update} {delete}',
			'deleteConfirmation'=>false,
			'deleteButtonUrl'=>'Yii::app()->controller->createUrl("deleteRole", array("name"=>$data["name"]))',
			'updateButtonUrl'=>'Yii::app()->controller->createUrl("modifyRole", array("name"=>$data["name"]))',
		),
	),
))?>