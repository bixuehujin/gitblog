<?php
/**
 * MemberController class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

class MemberController extends AdminController {
	
	public $defaultAction = 'roles';
	
	
	public function actionRoles() {
		$this->sectionTitle = Yii::t('admin', 'Roles List');
		$auth = Yii::app()->authManager;
		$roles = $auth->getAuthItems(2);
		$newRoles = array();
		foreach ($roles as $role) {
			$newRoles[] = array(
				'id'=>$role->name,
				'name'=>$role->name,
				'description'=>$role->description,
			);
		}
		$provider = new CArrayDataProvider($newRoles);
		$this->render('role-list', array(
			'rolesProvider'=>$provider,
		));
	}
	
	
	public function actionCreateRole() {
		$this->sectionTitle = Yii::t('admin', 'Create Role');
		$model = new RoleForm();
		
		if (isset($_POST['RoleForm'])) {
			$model->attributes = $_POST['RoleForm'];
			if($model->save()) {
				$this->refresh();
			}
		}
		
		$this->render('role-op', array(
			'model'=>$model,
		));
	}
	
	
	public function actionModifyRole() {
		
		$this->sectionTitle = Yii::t('admin', 'Modify Role');
		
		if (!isset($_GET['name'])) {
			throw new CHttpException(404);
		}
		
		$model = new RoleForm('modify');
		$model->loadByName($_GET['name']);
		
		if (isset($_POST['RoleForm'])) {
			$model->attributes = $_POST['RoleForm'];
			
			if ($model->update($_GET['name'])) {
				$this->redirect(array('/admin/member/modifyRole', 'name'=>$_POST['RoleForm']['name']));
			}
			
		}
		
		$this->render('role-op', array(
			'model'=>$model,
		));
	}
	
	
	public function actionDeleteRole() {
		$this->sectionTitle = Yii::t('admin', 'Delete Role');
		if (!isset($_GET['name'])) {
			throw new CHttpException(404);
		}
		
		$model = new RoleForm('delete');
		$model->loadByName($_GET['name']);
		
		if (isset($_POST['RoleForm'])) {
			$model->attributes = $_POST['RoleForm'];
			if($model->delete()) {
				$this->redirect(array('/admin/member'));
			}
		}
		
		$this->render('role-op', array(
			'model'=>$model,
		));
	}
	
	public function actionPermissions() {
		$this->sectionTitle = Yii::t('admin', 'Permission Management');
		$model = new PermissionForm();
		
		if (isset($_POST['PermissionForm'])) {
			$model->attributes = $_POST['PermissionForm'];
			if ($model->save()) {
				$this->refresh();
			}
		}
		
		$this->render('permissions', array(
			'dataProvider'=>$model->dataProvider,
			'columns'=>$model->columns,
			'model'=>$model,
		));
	}
	
	
	public function actionAccountList() {
		$this->sectionTitle = Yii::t('admin', 'Account List');
		
		$provider = new CActiveDataProvider('User');
		$provider->setCriteria(array(
			'order'=>'uid DESC',
		));
		
		$columns = array(
			'username::Account Name',
			'truename::Real Name',
			'gender::Gender',
			'email::Email',
			'github::Github Account',
			'weibo::Weibo Account',
			array(
				'class' => 'bootstrap.widgets.TbButtonColumn',
				'template'=>'{update} {delete}',
				'deleteConfirmation'=>true,
				'deleteButtonUrl'=>'Yii::app()->controller->createUrl("deleteAccount", array("id"=>$data->uid))',
				'updateButtonUrl'=>'Yii::app()->controller->createUrl("modifyAccount", array("id"=>$data->uid))',
			),
		);
		
		$this->render('account-list', array(
			'dataProvider'=>$provider,
			'columns'=>$columns,
		));
	}
	
	
	public function actionCreateAccount() {
		$this->sectionTitle = Yii::t('admin', 'Create Account');
		$model = new AccountForm('creation');
		
		if (isset($_POST['AccountForm'])) {
			$model->attributes = $_POST['AccountForm'];
			if ($model->save()) {
				$this->refresh();
			}
		}
		
		$this->render('account-op', array(
			'model'=>$model,
		));
	}
	
	
	public function actionModifyAccount() {
		$this->sectionTitle = Yii::t('admin', 'Modify Account');
		$model = new AccountForm(AccountForm::SCENARIO_MODIFICATION);
		
		if(isset($_POST['AccountForm'])) {
			$model->attributes = $_POST['AccountForm'];
			if($model->save()) {
				$this->refresh();
			}
		}
		
		$this->render('account-op', array(
			'model'=>$model,
		));
	}
	
	
	public function actionDeleteAccount() {
		//$this->redirect($url)
	}
	
	public function menuItems() {
		$route = Yii::app()->getUrlManager()->parseUrl(Yii::app()->getRequest());
		$items = array();
		$items[] = array('label'=>Yii::t('admin', 'Roles Management'));
		$items[] = array('label'=>Yii::t('admin', 'Roles List'), 'url'=>array('/admin/member/roles'));

		if (trim($route, '/') === 'admin/member/modifyRole') {
			$items[] = array('label'=>Yii::t('admin', 'Modify Role'), 'url'=>Yii::app()->request->url, 'active'=>true);
		}else if (trim($route, '/') === 'admin/member/deleteRole') {
			$items[] = array('label'=>Yii::t('admin', 'Delete Role'), 'url'=>Yii::app()->request->url, 'active'=>true);
		}else {
			$items[] = array('label'=>Yii::t('admin', 'Create Role'), 'url'=>array('/admin/member/createRole'));
		}
		
		$items[] = array('label'=>Yii::t('admin', 'Permission management'));
		$items[] = array('label'=>Yii::t('admin', 'Permission management'), 'url'=>array('/admin/member/permissions'));
		
		$items[] = array('label'=>Yii::t('admin', 'Account Management'));
		$items[] = array('label'=>Yii::t('admin', 'Account List'), 'url'=>array('/admin/member/accountList'));
		$items[] = array('label'=>Yii::t('admin', 'Create Account'), 'url'=>array('/admin/member/createAccount'));
		
		return $items;
	}
}
