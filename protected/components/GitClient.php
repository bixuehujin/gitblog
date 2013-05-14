<?php
/**
 * GitClient class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 * @since 2013-05-12
 */

use Git2\Tree;
use Git2\Reference;
use Git2\Repository;
use Git2\Blob;
use Git2\Commit;
use Git2\Signature;
use Git2\TreeBuilder;
use Git2\TreeEntry;

class GitClient extends CComponent {
	
	private $path;
	/**
	 * @var Git2\Repository
	 */
	private $repo;
	
	public function __construct($path) {
		$this->path = $path;
		$this->repo = Repository::init($this->path, false);
	}
	
	public function getParentsCommit() {
		$reference = Reference::lookup($this->repo, 'refs/heads/master');
		return array($reference->getTarget());
	}
	
	/**
	 * @return Tree
	 */
	protected function createEmptyTree() {
		$builder = new TreeBuilder();
		$oid = $builder->write($this->repo);
		return $this->repo->lookup($oid);
	}
	
	/**
	 * Build a new tree recursively.
	 * 
	 * @param Tree   $rootTree
	 * @param string $path
	 * @param string $oid
	 * @return string the oid of newly built tree. 
	 */
	public function buildTreeRecursive($currTree, $path, $oid) {
		if (($len = strpos($path, '/')) !== false) {//The subtree
			$currPath = substr($path, 0, $len);
			$leftPath = substr($path, $len + 1);
			
		}else { //the leaf
			$currPath = $path;
		}
		
		$builder = new TreeBuilder($currTree);
		if (isset($leftPath)) {
			
			$subTree = $currTree->getSubtree($currPath);
			if (!$subTree) {
				$subTree = $this->createEmptyTree();
			}
			
			$subTreeId = $this->buildTreeRecursive($subTree, $leftPath, $oid);
			$builder->insert(new TreeEntry(array(
				'oid' => $subTreeId,
				'name' => $currPath,
				'attributes' => octdec('0040000'),
			)));
		}else {
			$builder->insert(new TreeEntry(array(
				'oid' => $oid,
				'name' => $currPath,
				'attributes' => octdec('100644'),
			)));
		}
		return $builder->write($this->repo);
	}
	
	
	public function createAndCommit($contents, $file, $message) {
		$oid = Blob::create($this->repo, $contents);
		
		if (!$oid) {
			return false;
		}
		
		if (Yii::app() instanceof CConsoleApplication) {
			$username = 'Jin Hu';
			$email = 'bixuehujin@gmail.com';
		}else {
			$user = Yii::app()->user->getState('user');
			$username = $user->username;
			$email = $user->email;
		}
		
		$author = new Signature($username, $email, new DateTime());
		
		$commit = $this->repo->lookup($this->getParentsCommit()[0]);
		
		$rootTree = $commit->getTree();
		
		$newTreeid = $this->buildTreeRecursive($rootTree, $file, $oid);
		
		$parent = Commit::create($this->repo, array(
			'author' => $author,
			'committer' => $author,
			'message' => $message,
			'tree' => $newTreeid,
			'parents' => $this->getParentsCommit(),
		));
		return $parent;
	}
}
