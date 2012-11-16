<?php
class UserController extends AdminController {
	
	public $defaultAction = 'info';
	
	
	public function permissions() {
		return array(
			'user.permissionManagement'=>array(
				'description'=>'Perform user permission management'
			),
			'user.accountManagement'=>array(
				'description'=>'Perform user account management',	
			),
		);
	}
	
	public function menuItems() {
		return array(
			array('label'=>'基本信息', 'url'=>array('/admin/user/info')),
			array('label'=>'密码修改', 'url'=>array('/admin/user/password')),
		);
	}
	
	public function actionInfo() {
		$userModel = new UserForm();
		
		if(isset($_POST['UserForm'])) {
			$userModel->attributes = $_POST['UserForm'];
			if($userModel->save()) {
				Yii::app()->sessionMessager->addMessage('个人信息修改成功', 'success');
			}else {
				Yii::app()->sessionMessager->addMessage('个人信息修改失败', 'error');
			}
			$this->refresh();
		}
		
		
		$this->render('info', array(
			'userModel' => $userModel,
			'items' => $this->menuItems(),
		));
	}
	
	public function actionPassword() {
		$pwdModel = new PwdForm();
		if(isset($_POST['PwdForm'])) {
			if($pwdModel->change($_POST['PwdForm'])) {
				Yii::app()->sessionMessager->addMessage('密码修改成功', 'success');
			}else {
				Yii::app()->sessionMessager->addMessage('密码修改失败，' . $pwdModel->getErrorMsg() , 'error');
			}
			$this->refresh();
		}
		
		$this->render('password', array(
			'pwdModel' => $pwdModel,
			'items' => $this->menuItems(),
		));
	}
}