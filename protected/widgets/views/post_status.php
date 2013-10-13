<?php
/**
 * PostRevision widget template file.
 * 
 * @var PostRevision $this
 */
?>
<?php 
Yii::app()->clientScript->pregisterCssFile(__DIR__ . '/post_status.css');
?>
<div class="widget" id="widget-post-status">
	<div class="widget-title">
		<?php echo Yii::t('view', 'Post Status')?>
	</div>
	<div class="widget-content">
		<div>
		<?php echo Yii::t('view', 'Updated at {time}', array('{time}' => $this->lastCommitDate))?>
		<?php echo CHtml::link(Yii::t('view', 'View history'), array('/post/revisions', 'id' => $this->post->pid))?>
		</div>
		<div> <?php echo Yii::t('view', '{count} views', array('{count}' => $this->post->visitors + 1))?></div>
	</div>
</div>
