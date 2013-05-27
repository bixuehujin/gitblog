<?php
/**
 * User content setting template file.
 * 
 * @var ContentSettingForm $model
 */
?>
<?php 
Yii::app()->clientScript->pregisterCssFile(__DIR__ . '/account.css');
?>
<div class="inner">
<?php $this->renderPartial('/forms/gitsetting', array('model' => $model))?>
</div>
