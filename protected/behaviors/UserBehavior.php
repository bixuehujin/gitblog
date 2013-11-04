<?php
/**
 * UserBehavior class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

class UserBehavior extends CActiveRecordBehavior {
	
	public function events() {
		return array_merge(parent::events(), array(
			'onUserRegistered' => 'userRegistered'
		));
	}
	
	public function userRegistered($event) {
		$user = $event->sender;
		//initialize user settings
		$setting = UserSetting::model();
		$setting->create('repository', $user->username, $user->uid);
		$setting->create('branch', 'master', $user->uid);
		GitClient::createRepository($user->username, $user->username, $user->email);
		
		//send register email
		$mailgun = Yii::app()->getComponent('mailgun');
		$message = $mailgun->createMessage();
		$message->addRecipient($user->email, $user->username);
		$message->setSubject('欢迎注册 仁风的博客');
		$message->setContent('欢迎注册 仁风的博客');
		$mailgun->send($message);
	}
	
	public function beforeSave($event) {
		$user = $event->sender;
		if ($user->getIsNewRecord()) {
			$user->created = time();
		}
	}
}
