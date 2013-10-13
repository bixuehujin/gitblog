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
	'ownerType' => Yii::t('view', 'Message')
))?>


<?php $this->renderPartial('/comment/_comments', array(
	'provider' => $provider, 
	'ownerType' => Yii::t('view', 'Message'),
	'showReplyLink' => !Yii::app()->user->isGuest,
))?>
