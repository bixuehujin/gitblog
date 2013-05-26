<?php
/**
 * User messages template file.
 * 
 * @var CommentForm $model
 * @var CActiveDataProvider $provider 
 */
?>

<?php $this->renderPartial('/comment/_comment_form', array(
	'model' => $model, 
	'ownerType' => '留言'
))?>


<?php $this->renderPartial('/comment/_comments', array(
	'provider' => $provider, 
	'ownerType' => '留言',
	'showReplyLink' => !Yii::app()->user->isGuest,
))?>
