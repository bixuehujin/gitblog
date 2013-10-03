<?php
/**
 * User login block template file.
 */
?>
<?php 
Yii::app()->clientScript->pregisterCssFile(__DIR__ . '/user_login.css');
?>
<div class="widget" id="widget-user-login">
	<div class="widget-title">
		<?php echo Yii::t('view', 'Sign In')?>
	</div>
	<div class="widget-content">
		<?php $this->renderPartial('/forms/login', array('model' => $model))?>
	</div>
</div>
