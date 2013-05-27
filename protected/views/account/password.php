<?php
/**
 * Change password template file.
 * 
 * @var PasswordForm $model
 */
?>
<?php 
Yii::app()->clientScript->pregisterCssFile(__DIR__ . '/account.css');
?>

<div class="inner">
<?php $this->renderPartial('/forms/password', array('model' => $model))?>
</div>
