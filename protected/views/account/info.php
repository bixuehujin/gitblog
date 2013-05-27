<?php
/**
 * Account info template file(views/account/view.php).
 * 
 * Avaliable variables:
 * 
 * @var AccountController $this
 */
?>
<?php 
Yii::app()->clientScript->pregisterCssFile(__DIR__ . '/account.css');
?>
<div class="inner">
<?php $this->renderPartial('/forms/account_info', array('model' => $model)) ?>
</div>
