<?php
/**
 * TermTest class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

class TermTest extends CDbTestCase {
	
	protected $fixtures = array(
		'term' => 'Term',
		'term_vocabulary' => 'TermVocabulary',
		'term_hierarchy' => 'TermHierarchy',
	);
	
	public function testBuildTree() {
		$model = Term::model();
		$tree = $model->buildTree(1);
		$this->assertNotEmpty($tree);
		$this->assertEquals('level 1', $tree[1]->name);
		$this->assertEquals('level 2', $tree[2]->name);
		$this->assertEquals(2, count($tree));
	}
	
	public function testTermTreeWalk() {
		$model = Term::model();
		$tree = $model->buildTree(1);
		$newTree = $model->termTreeWalk($tree, function ($term) {
			return (array)$term;
		});
		print_r($newTree);
	}
}
