<?php
	$this->pageTitle = $post->title . ' | ' . $this->pageTitle;
	$this->breadcrumbs = Category::getCategoryBreadcrumbsArray($post->category->category_id, false)
		+ array($post->title);
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
		<?php $this->renderPartial('_post_comments', array('comments'=>$comments, 'post'=>$post))?>
		
	</div>
	
	<div class="span3">
		<div>reference there</div>
		<?php $this->renderPartial('/tag/_tag', array('tags'=>$post->tags))?>
	</div>
</div>
