<?php
/**
 * User avatar setting tempalte file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 * @since 2013-04-19
 * 
 * ----------------------------------------
 * 
 * Avaliable variables:
 * 
 * @var AvatarForm  $model
 */
?>
<?php 
Yii::app()->console->render();
Yii::app()->clientScript->pregisterCssFile(__DIR__ . '/account.css');
?>
<?php $this->renderPartial('/forms/avatar', array('model' => $model))?>

<div>
	<?php echo GitBlog::userAvatar(null)?>
</div>