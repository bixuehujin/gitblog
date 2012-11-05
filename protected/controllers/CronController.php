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
		$model = Commit::model();
		$model->resolveUnpreformedCommit();
	}
	
	
	
	
	//protected function savePostData($parser)
}