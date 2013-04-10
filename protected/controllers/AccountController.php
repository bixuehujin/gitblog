<?php
/**
 * AccountController class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

class AccountController extends Controller {

	public $defaultAction = 'info';
	
	public function init() {
		parent::init();
		$this->getPageLayout()->addColumnItem('left', '/sidebars/account');
	}
	
	public function actionInfo() {
		$this->setTitle('基本信息');
		$this->getPageLayout()->setBreadcrumbs(array(
			'设置' => array('/account'),
			'基本信息',
		));
		
		$accountInfo = new AccountInfoForm(null, User::load(Yii::app()->user->getId()));
		if (isset($_POST['AccountInfoForm'])) {
			$accountInfo->setAttributes($_POST['AccountInfoForm']);
			if ($accountInfo->save()) {
				$this->refresh();
			}
		}
		
		$this->render('info', array(
			'model' => $accountInfo,
		));
	}
	
	public function actionAvatar() {
		$this->setTitle('头像设置');
		$this->getPageLayout()->setBreadcrumbs(array(
			'设置' => array('/account'),
			'头像设置',
		));
		$this->render('avatar', array());
	}
	
	public function actionPassword() {
		$this->setTitle('密码修改');
		$this->getPageLayout()->setBreadcrumbs(array(
			'设置' => array('/account'),
			'密码修改',
		));
		
		$this->render('password', array());
	}
}
