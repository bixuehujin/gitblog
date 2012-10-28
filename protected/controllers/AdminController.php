<?php
class AdminController extends Controller {

	public $layout = 'admin';
	
	public function __construct($id, $module = null) {
		parent::__construct($id, $module);
		if(Yii::app()->user->isGuest) {
			$this->redirect(array('/site/login'));
		} 
	}

	public function actionIndex() {

		$this->render('index');
	}
	
	
	public function actionUser() {
		$userModel = new UserForm();
		$pwdModel = new PwdForm();
		if(isset($_POST['UserForm'])) {
			$userModel->attributes = $_POST['UserForm'];
			if($userModel->save()) {
				Yii::app()->sessionMessager->addMessage('个人信息修改成功', 'success');
			}else {
				Yii::app()->sessionMessager->addMessage('个人信息修改失败', 'error');
			}
		}

		if(isset($_POST['PwdForm'])) {
			if($pwdModel->change($_POST['PwdForm'])) {
				Yii::app()->sessionMessager->addMessage('密码修改成功', 'success');
			}else {
				Yii::app()->sessionMessager->addMessage('密码修改失败，' . $pwdModel->getErrorMsg() , 'error');
			}
		}
		
		$this->render('user', array(
				'userModel' => $userModel,
				'pwdModel' => $pwdModel
			));
	}
	

	public function actionGlobal() {
		$model = new GlobalForm();
		if(isset($_POST['GlobalForm'])) {
			$model->attributes = $_POST['GlobalForm'];
			if($model->save()) {
				Yii::app()->sessionMessager->addMessage('修改成功', 'success');
			}else {
				Yii::app()->sessionMessager->addMessage('修改失败', 'error');
			}
		}
		
		$this->render('global', array(
				'model' => $model,
			));
	}

	public function actionAbout() {

		$this->render('index');
	}
}