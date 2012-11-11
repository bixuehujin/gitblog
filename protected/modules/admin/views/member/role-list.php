<?php
/**
 * Member roles management template file.
 * 
 * @var MemberController $this
 * @var array $rolesProvider Array of role.
 * @var string $title 
 */
?>

<legend><?php echo $title?></legend>

<?php echo Yii::app()->sessionMessager->renderMessageWidget();?>

<?php 
$this->widget('bootstrap.widgets.TbGridView', array(
	'dataProvider'=>$rolesProvider,
	'columns'=>array(
		'name::角色名称',
		'description::描述',
		array(
			'class' => 'bootstrap.widgets.TbButtonColumn',
			'template'=>'{update} {delete}',
			'deleteConfirmation'=>false,
			'deleteButtonUrl'=>'Yii::app()->controller->createUrl("deleteRole", array("name"=>$data["name"]))',
			'updateButtonUrl'=>'Yii::app()->controller->createUrl("modifyRole", array("name"=>$data["name"]))',
		),
	),		
))?>