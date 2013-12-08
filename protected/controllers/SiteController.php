<?php
/**
 * SiteController class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com.
 * @since 2012-10-10
 */

class SiteController extends Controller {
	/**
	 * Declares class-based actions.
	 */
	public function actions() {
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha' => array(
				'class' => 'CCaptchaAction',
				'backColor' => 0xFFFFFF,
			),
			'thumbnail' => array(
				'class' => 'ecom\image\ImageThumbAction',
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page' => array(
				'class' => 'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex(){
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError() {
		if($error=Yii::app()->errorHandler->error) {
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin() {
		$model=new LoginForm;

		if(isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		
		$this->getPageLayout()->setState('section_title', '用户登陆');

		if(isset($_POST['LoginForm'])) {
			$model->attributes = $_POST['LoginForm'];
			if($model->login()) {
				$this->redirect(Yii::app()->user->returnUrl);
			}
				
		}
		$this->render('login',array('model' => $model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout(){
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	public function actionRegister() {
		if (!Yii::app()->settings->get('site_register_on', 1)) {
			throw new CHttpException(404);
		}
		$this->getPageLayout()->setState('section_title', '用户注册');
		$model = new RegisterForm();
		if (isset($_POST['RegisterForm'])) {
			$model->setAttributes($_POST['RegisterForm']);
			if ($model->save()) {
				$this->refresh();
			}
		}
		
		$this->render('register', array(
			'model' => $model,
		));
	}
	
	/**
	 * Password reset page.
	 */
	public function actionReset() {
		$this->getPageLayout()->setState('section_title', '密码重置');
		$token = Yii::app()->request->getQuery('token');
		if (!$token) {
			$model = new PasswordResetForm();
			if (isset($_POST['PasswordResetForm'])) {
				$model->setAttributes($_POST['PasswordResetForm']);
				if ($model->reset()) {
					$this->refresh();
				}
			}
			$this->render('reset', array(
				'model' => $model,
				'template' => '/forms/password_reset',
			));
			Yii::app()->end();
		}
		
		$template = '/forms/password';
		$data = explode(';', $token);
		if (isset($data[1]) && ($user = User::load($data[1])) && $user->getResetPasswordToken()) {
			$model = new PasswordForm(PasswordForm::SCENARIO_RESET, $user);
			if (isset($_POST['PasswordForm'])) {
				$model->setAttributes($_POST['PasswordForm']);
				if ($model->change()) {
					$this->redirect('/site/login');
				}
			}
			$this->render('reset', array(
				'model' => $model,
				'template' => $template,
			));
		}else {
			Yii::app()->console->addError('重置连接错误或已过期！');
			$this->redirect('/site/reset');
		}
	}
}
