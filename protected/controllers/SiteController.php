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
				'class' => 'ext.common.actions.ImageThumbnailAction',
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
}
