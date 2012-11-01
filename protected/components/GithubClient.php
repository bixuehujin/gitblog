<?php
use Github\Api\PullRequest;

/**
 * GithubClient class file
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

Yii::setPathOfAlias('Github', Yii::getPathOfAlias('application.vendors.Github'));
Yii::setPathOfAlias('Buzz', Yii::getPathOfAlias('application.vendors.Buzz'));

/**
 * swapper class for Github operations
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 *
 */
class GithubClient extends CComponent {
	/**
	 * @var \Github\Client
	 */
	static private $_client;
	
	public function __construct() {
		if (self::$_client == null || !self::$_client instanceof \Github\Client) {
			self::$_client = new \Github\Client();
		}
	}
	
	
	/**
	 * User object used to get user information on github.
	 * Methods of User object.
	 * :find($keyword) return list of users found.
	 * :show($username) return informations about the user.
	 * :following($username) return list of followed users.
	 * :followers($username) return list of following users.
	 * :watched($username) return list of watched repositories.
	 * :repositories($username) return list of the user repositories.
	 * :gists($username) return list of user gists.
	 * 
	 * @return \Github\Api\User
	 */
	public function user() {
		return self::$_client->api('user');
	}
	
	/**
	 * @return \Github\Api\GitData\Blobs
	 */
	public function blobs() {
		return self::$_client->api('git')->blobs();
	}
	
	/**
	 * @return \Github\Api\GitData\Commits
	 */
	public function commits() {
		return self::$_client->api('git')->commits();
	}
	
	/**
	 * @return \Github\Api\GitData\References
	 */
	public function references() {
		return self::$_client->api('git')->references();
	}
	
	/**
	 * @return \Github\Api\GitData\Tags
	 */
	public function tags() {
		return self::$_client->api('git')->tags();
	}
	
	/**
	 * @return \Github\Api\GitData\Trees
	 */
	public function trees() {
		return self::$_client->api('git')->trees();
	}
	
	/**
	 * @return \Github\Api\Gists
	 */
	public function gists() {
		return self::$_client->api('gists');
	}
	
	/**
	 * 
	 * @return \Github\Api\Issue
	 */
	public function issue() {
		return self::$_client->api('issue');
	}
	
	/**
	 * 
	 * @return Ambigous \Github\Api\Markdown
	 */
	public function markdown() {
		return self::$_client->api('markdown');
	}
	
	/**
	 * 
	 * @return \Github\Api\PullRequest
	 */
	public function pullRequest() {
		return self::$_client->api('pr');
	}
	
	/**
	 * 
	 * @return \Github\Api\Repo
	 */
	public function repo() {
		return self::$_client->api('repo');
	}
	
	/**
	 * Authenticate a user for all next requests.
	 * 
	 * @param string $tokenRoLogin
	 * @param string $password
	 * @param string $authMethod one of url_token, url_client_id, http_password, http_token
	 */
	public function authenticate($tokenOrLogin, $password=null, $authMethod = null) {
		return self::$_client->authenticate($tokenOrLogin, $password, $authMethod);
	}
	
}