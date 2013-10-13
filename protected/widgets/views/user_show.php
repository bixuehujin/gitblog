<?php
/**
 * UserShow widget tempalte file.
 * 
 * @var 
 */
?>
<?php 
Yii::app()->clientScript->pregisterCssFile(__DIR__ . '/user_show.css');
?>
<div class="widget" id="widget-user-show">
	<?php if ($this->showTitle):?>
	<div class="widget-title"><?php echo Yii::t('view', 'About Author')?></div>
	<?php endif;?>
	<div class="avatar clearfix">
		<div class="photo pull-left">
			<?php echo GitBlog::userAvatarLink($user, 'medium')?>
		</div>
		<div class="username pull-left">
			<div><?php echo GitBlog::username($user)?></div>
			<div class="intro"><?php echo $user->intro?></div>
		</div>
	</div>
	<ul class="status">
		<li><a href="<?php echo Yii::app()->createUrl('user/', array('id' => $user->uid))?>"><?php echo Yii::t('view', 'Articles')?>(<?php echo $this->articleCount?>)</a></li>
		<li><a href="<?php echo Yii::app()->createUrl('user/topics', array('id' => $user->uid))?>"><?php echo Yii::t('view', 'Topics')?>(<?php echo $this->topicCount?>)</a></li>
	</ul>
</div>

