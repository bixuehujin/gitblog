<?php
/**
 * Account operation(creation, modification) template file.
 * 
 * Avaliable variables:
 * @var AdminController $this
 * @var AccountForm $model
 */
?>

<?php 
$this->renderPartial('form/_account', array(
	'model'=>$model,
))
?>
