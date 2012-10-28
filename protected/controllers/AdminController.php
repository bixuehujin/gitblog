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
		$model = new UserForm();
		
		if(isset($_POST['UserForm'])) {
			$model->attributes = $_POST['UserForm'];
			if($model->save()) {
				Yii::app()->sessionMessager->addMessage('个人信息修改成功', 'success');
			}else {
				Yii::app()->sessionMessager->addMessage('个人信息修改失败', 'error');
			}
		}	
		$this->render('user', array('model' => $model));
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
		
		$this->render('global', array('model' => $model));
	}

	public function actionAbout() {

		$this->render('index');
	}
}