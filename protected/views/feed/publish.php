<?php
/**
 * Post publish template file.
 * 
 * Avaliable variables:
 * 
 * @var PostForm $model
 */
?>
<?php 
Yii::app()->clientScript->pregisterCssFile(__DIR__ . '/feed.css')
?>
<?php $this->renderPartial('/forms/post', array(
	'model' => $model,
))?>
