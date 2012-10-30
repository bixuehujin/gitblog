<?php
	$this->pageTitle = $post->title . ' | ' . $this->pageTitle;
	$this->breadcrumbs = array(
		$post->category->name => array('/view/category', 'id'=>$post->category->category_id),
		$post->title
	);
?>

<div class="row">
	<div class="span9">
	
		<?php $this->renderPartial('_post_view', array('post'=>$post))?>
		
		<?php 
			$this->renderPartial('/comment/_comment_form', array(
				'commentForm' => $commentForm,
				'post' => $post,
			));
		?>
		<?php $this->renderPartial('_post_comments', array('comments'=>$comments))?>
		
	</div>
	
	<div class="span3">
		reference and infomation
	</div>
</div>
