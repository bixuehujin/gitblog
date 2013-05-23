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
	<div class="widget-title">关于作者</div>
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
		<li><a href="">文章(0)</a></li>
		<li><a href="">专题(0)</a></li>
	</ul>
</div>

