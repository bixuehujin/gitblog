<?php
/**
 * UserShow widget class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 * @since 2013-05-23
 */

/**
 * @property User $user
 */
class UserShow extends CWidget {
	
	/**
	 * The user to show.
	 * 
	 * @var User
	 */
	private $user;
	
	public $showTitle = false;
	
	public function setUser($user) {
		if (!$user instanceof User) {
			$user = User::load($user);
			if (!$user) {
				throw new CException("The user '$user' cann't be load from database.");
			}
		}
		$this->user = $user;
		return $this;
	}
	
	public function getUser() {
		if ($this->user === null) {
			$this->user = Yii::app()->user->getState('user');
		}
		return $this->user;
	}
	
	public function getArticleCount() {
		return $this->getUser()->getArticles();
	}
	
	public function getTopicCount() {
		return $this->getUser()->getTopics();
	}
	
	public function run() {
		$this->renderFile($this->getViewFile('user_show'), array(
			'user' => $this->getUser()
		));
	}
}
