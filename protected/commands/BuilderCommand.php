<?php
/**
 * BuilderCommand class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 * @since 2013-05-14
 */

class BuilderCommand extends CConsoleCommand {
	
	private $identifier;
	/**
	 * @var User
	 */
	private $user;
	/**
	 * @var GitClient
	 */
	private $client;
	
	
	protected function getClient() {
		if ($this->client === null) {
			$path = Yii::app()->settings->get('git_base_path');
			$path .= '/' . $this->user->getSetting('repository') . '.git';
			$this->client = new GitClient($path);
		}
		return $this->client;
	}
	
	
	public function run($args) {
		if (!$this->parseOptions($args)) {
			echo $this->getHelp();
			return 1;
		}
		
		$lastCommit = $this->user->getSetting('last_commit');
		$client = $this->getClient();
		$commitsOld = $commits = $client->listCommitUntil($lastCommit);
		
		if (empty($commitsOld)) {
			printf("[INFO] No commit needs to resolve, exiting...\n");
			return;
		}
		
		array_shift($commitsOld);
		if ($lastCommit) {
			$commitsOld[] = $this->client->getCommitByOid($lastCommit);
		}
		foreach ($commitsOld as $i => $commitOld) {
			$diff = $this->client->diffCommit($commitOld, $commits[$i]);
			//var_dump($commits[$i]->getTree());
			$this->parseDiffFiles($diff, $commits[$i]);
		}
		
		if (!$lastCommit) {//deal with the firset init commit.
			//TODO DO NOT SUPPORT TREE!
			foreach ($commitOld->getTree() as $entry) {
				$content = $this->client->fetchBlobContent($entry->oid);
				$this->parseContent($content, $entry->name, $commitOld->getMessage(), $entry->oid);
			}
		}
		$this->user->setSetting('last_commit', $commits[0]->getOid());
	}

	protected function parseDiffFiles($diff, $currCommit) {
		if (isset($diff['A'])) {
			foreach ($diff['A'] as $filename) {
				$content = $this->client->fetchContentByPath($currCommit->getTree(), $filename, $oid);
				$this->parseContent($content, $filename, $currCommit->getMessage(), $oid);
			}
		}else if (isset($diff['M'])) {
			foreach ($diff['M'] as $filename) {
				$content = $this->client->fetchContentByPath($currCommit->getTree(), $filename, $oid);
				$this->parseContent($content, $filename, $currCommit->getMessage(), $oid);
			}
		}else {
			
		}
	}
	
	/**
	 * Parse a single content.
	 * 
	 * @param string $content
	 * @param string $filename
	 * @param string $message The commit message.
	 */
	protected function parseContent($content, $filename, $message, $oid) {
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		if (in_array($ext, array('md', 'markdown'))) {
			$parser = new PostParser($content);
			if ($parser->parse()) {
				$meta = $parser->meta;
				$post = Post::loadByPath($filename);
				$newPost = false;
				if (!$post) {
					$newPost = true;
					$post = new Post();
					$post->author = $post->committer = $this->user->uid;
					$post->oid = $oid;
					$post->path = $filename;
					if (isset($meta['topic']) && $meta['topic'] == 'true') {
						$post->type = Post::TYPE_TOPIC;
					}
					$post->title = $meta['title'];
					$post->save(false);
				}
				
				$revision = new PostRevision();
				$revision->post_id = $post->pid;
				$revision->oid = $oid;
				$revision->creator = $this->user->uid;
				$revision->title = $meta['title'];
				$revision->meta = $parser->rawMeta;
				$revision->path = $filename;
				$revision->content = $parser->rawBody;
				$revision->commit = $message;
				$revision->save(false);
				
				if ($newPost) {
					$post->author = $this->user->uid;
				}
				$post->committer = $this->user->uid;
				$post->rid = $revision->rid;
				$post->save(false);
				
				$post->applyCategory($meta['category']);
				$post->applyTags($meta['tags']);
				
			}
		}else if (in_array($ext, array('jpg', 'png', 'jpeg', 'gif'))) {
			
		}
	}
	
	
	/**
	 * Parse command line options.
	 * 
	 * @param  $args
	 * @return boolean
	 */
	protected function parseOptions($args) {
		list($action, $options, $args)=$this->resolveRequest($args);
		if (!isset($options['identifier'])) {
			return false;
		}

		foreach (array('identifier') as $option) {
			if (isset($options[$option])) {
				$this->$option = $options[$option];
			}
		}
		if(!($this->user = $user = User::load($this->identifier))) {
			printf("No record matched by identifier '{$this->identifier}'.\n");
			return false;
		}
		return true;
	}
	
	
	public function getHelp() {
		return <<<EOF
USAGE
  yiic builder <options>

DESCRIPTION
  This command build repo raw data to structured record in database.

PARAMETERS

   The following options are available:

   - identifier: string, the identifier of a user, uid, username or email.


EOF;
	}
}
