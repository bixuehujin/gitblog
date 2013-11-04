<?php
/**
 * GitClientTest class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

class GitClientTest extends CDbTestCase {
	
	protected function setUp() {
		parent::setUp();
		$path = __DIR__ . '/repos';
		Yii::app()->settings->set('git_base_path', $path);
		if (!file_exists($path)) {
			mkdir($path);
		}
	}
	
	public function testCreateRepository() {
		$this->assertInstanceOf('Git2\Repository', GitClient::createRepository('name', 'Test', 'test@example.com'));
		$info = new SplFileInfo(Yii::app()->settings->get('git_base_path') . '/name.git/hooks/post-receive');
		$this->assertTrue($info->isExecutable());
		
		/*
		$config = new Git2\Config(Yii::app()->settings->get('git_base_path') . '/name.git/config');
		$this->assertEquals('Test', $config->get('user.name'));
		$this->assertEquals('test@example.com', $config->get('user.email'));
		*/
	}
}
