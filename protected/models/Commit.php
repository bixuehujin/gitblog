<?php
/**
 * Commit model class file
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

class Commit extends CActiveRecord {
	/**
	 * the commit have not be preformed, this the default status.
	 */
	const STATUS_NOT_PREFORM = 0;
	/**
	 * the commit had be preformed but failed, need preform again.
	 */
	const STATUS_FAILED = 1;
	/**
	 * everything is ok.
	 */
	const STATUS_SUCCEED = 2;
	
	protected $github;
	
	static public function model($className = __CLASS__) {
		return parent::model($className);
	}
	
	public function tableName() {
		return 'commit';
	}
	
	public function relations() {
		return array(
			'userSettings'=>array(self::HAS_ONE, 'UserSetting', array('uid'=>'uid')),
		);
	}
	
	public function afterFind() {
		$this->added = unserialize($this->added);
		$this->removed = unserialize($this->removed);
		$this->modified = unserialize($this->modified);
		$this->extra = unserialize($this->extra);
		return parent::afterFind();
	}
	
	public function beforeSave() {
		$this->added = serialize($this->added);
		$this->removed = serialize($this->removed);
		$this->modified = serialize($this->modified);
		$this->extra = serialize($this->extra);
		return parent::beforeSave();
	}
	
	/**
	 * check for unpreformed commits.
	 * 
	 * @param int $limit
	 * @return bool
	 */
	public function resolveUnpreformedCommit($limit = 5) {
		
		$commits = $this->findAll(array(
			'condition' => 'status=' . self::STATUS_NOT_PREFORM,
			'with'=>'userSettings',
		));
		try {
			foreach($commits as $commit) {
				$this->parseSingleCommit($commit);
			}
		}catch (Exception $e) {
			echo $e->getMessage();
			return false;
		}
		return true;
	}
	
	/**
	 * parse single commit and save changes to database.
	 *
	 * @param object $commit object contains commit information fetched from database.
	 * @throws Exception 
	 */
	protected function parseSingleCommit($commit) {
		$github = new GithubClient();
		
		$commitInfo = $github->commits()->show($commit->userSettings->github, $commit->userSettings->repository, $commit->commit_id);
		foreach($commitInfo['files'] as $file) {
			$raw = $github->blobs()->show($commit->userSettings->github, $commit->userSettings->repository, $file['sha']);
			$content = base64_decode($raw['content']);
			$parser = new PostParser($content);
			$parser->parse();
				
			if (isset($parser->meta['status']) && $parser->meta['status'] == 'published') {
				$timestamp = DateTime::createFromFormat('Y-m-d\TH:i:s\Z', $commitInfo['commit']['author']['date'])->getTimestamp();
		
				$postModel = Post::model();
				$post = $postModel->findByPath($file['filename']);
				$isNewPost = $post ? false : true;
				if (!$post) {
					$post = new Post();
					$post->path = $file['filename'];
					$post->title = $parser->meta['title'];
					$post->uid = $commit->userSettings->uid;
					$post->category_id = isset($parser->meta['category']) ? Category::getIdByName($parser->meta['category']) : 0;
					//$post->summary;
					$post->created  = $timestamp;
					$post->save(false);
				}
		
				$postRevision = PostRevision::model()->findByShaAndPostID($file['sha'], $post->post_id);
				if(!$postRevision) {
					$postRevision = new PostRevision();
					$postRevision->reference = $parser->reference;
					$postRevision->body = $parser->content;
					$postRevision->version = $isNewPost ? 1 : $post->version + 1;
					$postRevision->created = $timestamp;
					$postRevision->sha = $file['sha'];
					$postRevision->post_id = $post->post_id;
					$postRevision->save(false);
				}
		
				$post->version = $isNewPost ? 1 : $post->version + 1;
				$post->modified = $timestamp;
				$post->revision_id = $postRevision->revision_id;
				$post->update(array('version', 'modified', 'revision_id'));
				
				if(isset($parser->meta['tags'])) {
					$post->updateTags($parser->meta['tags']);
				}
			}
		}
		$commit->status = Commit::STATUS_SUCCEED;
		$commit->update(array('status'));
	}
	
}