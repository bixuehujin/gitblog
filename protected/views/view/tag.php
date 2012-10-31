<?php
/**
 * view posts by tag.
 * $posts: array of Post object.
 */
?>

<?php 
$this->breadcrumbs = array(
	'标签'=>'#',
	Tag::getTag($_GET['id'])->name
);
?>

<div class="row">
	<div class="span9">
		<div class="posts">
			<?php foreach($posts as $post):?>
			
				<?php $this->renderPartial('/view/_post', array('post' => $post))?>
				
			<?php endforeach;?>
		</div>
	</div>
	
	<div class="span3">
		other infomation
	</div>
</div>