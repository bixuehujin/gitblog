<?php
class PostParserTest extends CTestCase {
	
	public function testParser() {
		$content = file_get_contents( __DIR__ . '/markdown/test.md');
		$parser = new PostParser($content);
		$parser->parse();
		
		$this->assertEquals(array(
			'title'=>'test post title',
			'status'=>'published'		
		), $parser->meta);

		$this->assertEquals(array(
			array('title'=>'h2_1', 'level'=>2, 'items'=>array(
				array('title'=>'h3_1' ,'level'=>3),
				array('title'=>'h3_2' ,'level'=>3, 'items'=>array(
					array('title'=>'h4_1' ,'level'=>4),
					array('title'=>'h4_2' ,'level'=>4),
				)),
			)),
			array('title'=>'h2_2' ,'level'=>2),
			array('title'=>'h2_3 space' ,'level'=>2, 'items'=>array(
				array('title'=>'h33_1', 'level'=>3),
				array('title'=>'h33_2', 'level'=>3),
			)),
		), $parser->reference);
	}
}
