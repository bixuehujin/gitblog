<?php
/**
 * templete to render a comments list.
 * 
 * $comments: array of comment object.
 * $post: the post obejct comments attached.
 * @var bool $showAllLink whether show view-all link in title bar.
 */
?>

<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/comments.js');
Yii::app()->clientScript->registerPackage('jquery.scrollTo');
?>

<div class="comments">
	<legend class="clearfix">
		<span class="title">评论列表 (<?php echo $post->num_comments?>)</span>
		<?php
			if(isset($showAllLink) && $showAllLink) { 
				echo CHtml::link('查看全部', array('/view/comments', 'id'=>$post->post_id), array('class'=>'view-all'));
			}
		?>
	</legend>
	<?php foreach ($comments as $comment):?>
	
		<?php echo $this->renderPartial('/comment/_comment', array('comment'=>$comment))?>
		
	<?php endforeach;?>	
</div>
