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
use Git2\Walker;


/**
 * Sort the repository contents in no particular ordering;
 * this sorting is arbitrary, implementation-specific
 * and subject to change at any time.
 * This is the default sorting for new walkers.
 */
define('GIT_SORT_NONE', 0);

/**
 * Sort the repository contents in topological order
 * (parents before children); this sorting mode
 * can be combined with time sorting.
 */
define('GIT_SORT_TOPOLOGICAL', 1 << 0);

/**
 * Sort the repository contents by commit time;
 * this sorting mode can be combined with
 * topological sorting.
 */
define('GIT_SORT_TIME', 1 << 1);
/**
 * Iterate through the repository contents in reverse
 * order; this sorting mode can be combined with
 * any of the above.
 */
define('GIT_SORT_REVERSE', 1 << 2);

class GitClient extends CComponent {
	
	private $path;
	/**
	 * @var Git2\Repository
	 */
	private $repo;
	
	public function __construct($path) {
		$this->path = $path;
		$this->repo = Repository::init($this->path, true);
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
	
	/**
	 * 
	 * @param string $utilOid
	 * @return Git2\Commit[]
	 */
	public function listCommitUntil($utilOid = null) {
		$ref = Reference::lookup($this->repo, 'refs/heads/master');
		$headCommit = $ref->getTarget();
		$walker = new Walker($this->repo);
		$walker->push($headCommit);
		$walker->sorting(GIT_SORT_TIME | GIT_SORT_TOPOLOGICAL);
		$commits = array();
		foreach ($walker as $item) {
			if ($item->getOid() == $utilOid) {
				break;
			}
			$commits[] = $item;
		}
		return $commits;
	}
	
	/**
	 * @param Git2\Commit $oldCommit
	 * @param Git2\Commit $newCommit
	 * @return array(
	 *           'A' => array(),
	 *           'M' => array(),
	 *           'D' => array()
	 *         )
	 */
	public function diffCommit($oldCommit, $newCommit) {
		$res = $this->repo->diff($oldCommit->getTree(), $newCommit->getTree());
		$res = explode("\n", trim($res));
		$ret = array();
		foreach ($res as $row) {
			$ret[$row[0]][] = substr($row, 2);
		}
		return $ret;
	}
	
	public function fetchBlobContent($oid) {
		return $this->repo->lookup($oid)->getContent();
	}

	/**
	 * @param Git2\Tree $tree
	 * @param string    $filename
	 */
	public function fetchContentByPath($tree, $filename, &$oid = null) {
		if (($pathLen = strrpos($filename, '/')) === false) {
			$entry = $tree->getEntryByName($filename);
		}else {
			$path = substr($filename, 0, $pathLen);
			$filename = substr($filename, $pathLen + 1);
			$subTree = $tree->getSubtree($path);
			$entry = $subTree->getEntryByName($filename);
		}
		if (!$oid) {
			$oid = $entry->oid;
		}
		return $this->repo->lookup($entry->oid)->getContent();
	}
	
	/**
	 * @return Git2\Commit
	 */
	public function getCommitByOid($oid) {
		return $this->repo->lookup($oid);
	}
	
	/**
	 * Create and initialize an empty git repository based on [git_base_path].
	 * 
	 * @param string $name
	 * @return bool
	 * @throws CException
	 */
	public static function createRepository($name, $username, $email) {
		$gitBasePath = Yii::app()->settings->get('git_base_path', '/home/gitdaemon');
		if (!is_dir($gitBasePath) || !is_writable($gitBasePath)) {
			throw new CException("The git base path '$gitBasePath' is not a writable directory.");
		}
		$path = $gitBasePath . '/' . $name . '.git';
		
		$repo = Repository::init($path, true);
		if ($repo) {
			$target = $path . '/hooks/post-receive';
			copy(Yii::app()->getBasePath() . '/scripts/post-receive', $target);
			chmod($target, 0755);
			
			$config = new Git2\Config($path . '/config');
			$config->store('user.name', $username);
			$config->store('user.email', $email);
		}
		return $repo;
	}
}

