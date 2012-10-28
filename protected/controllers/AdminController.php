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

	public function actionGlobal() {

		$this->render('index');
	}

	public function actionAbout() {

		$this->render('index');
	}
}