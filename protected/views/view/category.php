<?php 
/**
 * view posts by category.
 */
?>

<?php
if (isset($_GET['id'])) {
	$this->breadcrumbs = Category::getCategoryBreadcrumbsArray($_GET['id']);
}
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