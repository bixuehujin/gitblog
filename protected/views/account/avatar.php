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
<?php Yii::app()->console->render()?>
<?php $this->renderPartial('/forms/avatar', array('model' => $model))?>

<div>
	<?php echo GitBlog::userAvatar(null)?>
</div>