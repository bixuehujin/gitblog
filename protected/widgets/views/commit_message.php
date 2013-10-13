<?php
/**
 * CommitMessage widget template file.
 * 
 */
?>

<div class="widget" id="widget-commit-message">
	<div class="widget-title">
		<?php echo Yii::t('view', 'Revision information')?>
	</div>
	<div class="widget-content">
		<?php echo $this->commit?>
	</div>
</div>
