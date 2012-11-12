<?php
/**
 * 
 */
?>

<legend>授权管理</legend>

<?php $this->renderPartial('form/_permission', array(
	'dataProvider'=>$dataProvider,
	'columns'=>$columns,
	'model'=>$model,
))?>