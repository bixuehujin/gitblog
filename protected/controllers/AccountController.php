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
		$model = new AvatarForm();
		if (!empty($_FILES)) {
			$model->save();
		}
		
		$this->render('avatar', array(
			'model' => $model,
		));
	}
	
	public function actionPassword() {
		$this->setTitle('密码修改');
		$this->getPageLayout()->setBreadcrumbs(array(
			'设置' => array('/account'),
			'密码修改',
		));
		$model = new PasswordForm(PasswordForm::SCENARIO_CHANGE, User::load(Yii::app()->user->getId()));
		if (isset($_POST['PasswordForm'])) {
			$model->setAttributes($_POST['PasswordForm']);
			if ($model->change()) {
				$this->refresh();
			}
		}
		$this->render('password', array(
			'model' => $model,
		));
	}
	
	public function actionContent() {
		$this->setTitle('内容设定');
		$this->getPageLayout()->setBreadcrumbs(array(
			'设置' => array('/account'),
			'内容设定',
		));
		$model = new GitSettingForm();
		if (isset($_POST['GitSettingForm'])) {
			$model->setAttributes($_POST["GitSettingForm"]);
			if ($model->save()) {
				$this->refresh();
			}
		}
		$this->render('content', array(
			'model' => $model,
		));
	}
}
