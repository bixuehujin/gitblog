<?php
/**
 * GitCommand class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

use Git2\Repository;
use Git2\Walker;
use Git2\Tree;
use Git2\TreeBuilder;

Yii::import('application.components.*');

class GitCommand extends CConsoleCommand {
	
	public function run($args) {
		/*
		$repo = Repository::init('/var/www/gitblog/repo/githook-test', false);
		$commit = $repo->lookup('1477eef55c8d2c5b0be6f77dabcdcbdfd11b0033');
		$tree = $commit->getTree();
		foreach ($tree as $entry) {
			echo sprintf("%s: %s\n", $entry->oid, $entry->name);
		}
		echo $repo->hash('tests', 2), "\n";
		var_dump($tree->getSubtree('posts/gitblog'));
		var_dump($tree->getEntryByName('tests'));
		*/
		
		$client = new GitClient('/var/www/gitblog/repo/githook-test');
		$ret = $client->createAndCommit("test content\ncontent\ncontent\n", 'posts/test--.md', 'test commit');
		var_dump($ret);
		$ret = $client->createAndCommit("test content2\ncontent2\ncontent2\n", 'd/d/test--.md', 'test commit2');
		var_dump($ret);
		
		/*
		$repo = Repository::init('/var/www/gitblog/repo/githook-test', false);
		$walk = new Walker($repo);
		$walk->push('a468619f5b02f070c5d3b84785f820509f6fcb07');
		foreach ($walk as $item) {
			var_dump($item->getMessage());
			$tree = $item->getTree();
			var_dump($tree);
			exit();
		}
		*/
	}
	
	public function getHelp() {
		
	}
	
}
