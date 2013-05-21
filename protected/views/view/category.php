<?php 
/**
 * view posts by category.
 * 
 * @var $this Controller
 * @var $post Post object
 * @var $pagination Pagination 
 */
?>
<?php 
Yii::app()->clientScript->pregisterCssFile(__DIR__ . '/view.css');
?>


<?php $this->renderPartial('/common/navigation')?>

<?php $this->renderPartial('/post/_posts', array('provider'=>$provider))?>


<?php 
$this->getPageLayout()->addColumnItem('sidebar', 'application.widgets.WeiboShow', array(
	'uid'=>'1747900082',
	'showFans'=>0,
	'height'=>400,
))
?>
