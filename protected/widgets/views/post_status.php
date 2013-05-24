<?php
/**
 * PostRevision widget template file.
 * 
 * @var PostRevision $this
 */
?>
<?php 
$url = Yii::app()->createUrl('post/visitors', array('id' => $this->post->pid));
Yii::app()->clientScript->pregisterCssFile(__DIR__ . '/post_status.css')
	->registerScript('post_status', "$.get('$url')", CClientScript::POS_READY);
?>
<div class="widget" id="widget-post-status">
	<div class="widget-title">
		文章状态
	</div>
	<div class="widget-content">
		<div>最近更新于 <?php echo $this->lastCommitDate?> 
		<?php echo CHtml::link('查看历史版本', array('/post/revisions', 'id' => $this->post->pid))?></div>
		<div>文章总访问数 <?php echo $this->post->visitors + 1?></div>
	</div>
</div>
