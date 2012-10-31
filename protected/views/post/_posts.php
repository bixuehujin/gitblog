<?php
/**
 * @var $this Controller
 * @var $posts array of Post object.
 */
?>

<div class="posts">
	<?php foreach($posts as $post):?>
	
		<?php $this->renderPartial('/post/_post', array('post' => $post))?>
		
	<?php endforeach;?>
</div>
