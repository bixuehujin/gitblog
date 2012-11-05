<?php
/**
 * CronController class file
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

class CronController extends Controller {
	
	private $_github;
	
	/**
	 * get GithubClient object.
	 * 
	 * @return GithubClient
	 */
	protected function getGithub() {
		if ($this->_github instanceof GithubClient) {
			return $this->_github;
		}else {
			return $this->_github = new GithubClient();
		}
	}
	
	/**
	 * trigger a cron via remote requests.
	 */
	public function actionTrigger() {
		$this->doParseCommitCron();
	}
	

	protected function doParseCommitCron() {
		$commitModel = Commit::model();
		
		$criteria = new CDbCriteria();
		$criteria->condition = "status=" . Commit::STATUS_NOT_PREFORM;
		$criteria->with = 'userSettings';
		
		
		$commits = $commitModel->findAll($criteria);
		try {
			foreach($commits as $commit) {
				$this->parseSingleCommit($commit);
			}
		}catch (Exception $e) {
			echo $e->getMessage();
		}
	}
	
	/**
	 * parse single commit and save changes to database.
	 * 
	 * @param object $commit object contains commit information fetched from database.
	 * @return bool true on success, otherwise false.
	 */
	protected function parseSingleCommit($commit) {
		$github = $this->getGithub();
		
		$commitInfo = $github->commits()->show($commit->userSettings->github, $commit->userSettings->repository, $commit->commit_id);
		var_dump($commitInfo);
		echo "\n\n\n";
		foreach($commitInfo['files'] as $file) {
			$raw = $github->blobs()->show($commit->userSettings->github, $commit->userSettings->repository, $file['sha']);
			$content = base64_decode($raw['content']);
			var_dump($raw);
			//echo base64_decode($raw['content']), "\n";
		}
	}
}