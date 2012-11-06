<?php
/**
 * PostTest class file.
 * @author Jin Hu <bixuehujin@gmail.com>
 */
class PostTest extends CDbTestCase {
	
	public $fixtures = array(
		'post'=>'Post',
		'tag'=>'Tag',
		'post_tag'=>'PostTag',
		'category'=>'Category'
	);
	
	public function testTags() {
		//test for Post::updateTags();
		$post_id = 1;
		$model = Post::model();
		$post=$model->find('post_id=' . $post_id);
		$ret = $post->updateTags(array('MVC', 'PHP'));
		$this->assertTrue($ret);
		$names = PostTag::getTagNames($post_id);
		$this->assertContains('PHP', $names);
		$this->assertContains('MVC', $names);
		$this->assertNotContains('Linux', $names);
	}
	
}
