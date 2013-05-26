<?php 
/**
 * view topics by category.
 * 
 * @var Controller $this 
 * @var CActiveDataProvider $provider post list provider.
 */
?>
<?php 
Yii::app()->clientScript->pregisterCssFile(__DIR__ . '/view.css');
?>


<?php $this->renderPartial('/common/navigation')?>

<?php $this->renderPartial('/post/_posts', array('provider'=>$provider))?>


