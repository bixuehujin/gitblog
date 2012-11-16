<?php
/**
 * user list template file.
 * 
 * Avaliable variables:
 * @var CActiveDataProvider $dataProvider 
 * @var array $columns 
 */
?>

<?php 
$this->widget('bootstrap.widgets.TbGridView', array(
	'dataProvider'=>$dataProvider,
	'columns'=>$columns,
))
?>



