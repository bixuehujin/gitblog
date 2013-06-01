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
		
		$user = User::fetchUserByRepo('/home/gitdaemon/githook.git');
		var_dump($user);
	}
	
	public function getHelp() {
		
	}
	
}
