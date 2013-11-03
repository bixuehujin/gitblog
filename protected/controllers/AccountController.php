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
		$this->setTitle(Yii::t('view', 'Profile'));
		$this->getPageLayout()->setBreadcrumbs(array(
			Yii::t('view', 'Settings') => array('/account'),
			Yii::t('view', 'Profile'),
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
		$this->setTitle(Yii::t('view', 'Avatar Setting'));
		$this->getPageLayout()->setBreadcrumbs(array(
			Yii::t('view', 'Settings') => array('/account'),
			Yii::t('view', 'Avatar'),
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
		$this->setTitle(Yii::t('view', 'Change Password'));
		$this->getPageLayout()->setBreadcrumbs(array(
			Yii::t('view', 'Settings') => array('/account'),
			Yii::t('view', 'Password'),
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
	
	public function actionRepository() {
		$this->setTitle(Yii::t('view', 'Repository Setting'));
		$this->getPageLayout()->setBreadcrumbs(array(
			Yii::t('view', 'Settings') => array('/account'),
			Yii::t('view', 'Repository'),
		));
		$model = new GitSettingForm();
		if (isset($_POST['GitSettingForm'])) {
			$model->setAttributes($_POST["GitSettingForm"]);
			if ($model->save()) {
				$this->refresh();
			}
		}
		$this->render('repository', array(
			'model' => $model,
		));
	}
}
