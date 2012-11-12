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
		$this->sectionTitle = '授权管理';
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
	
	public function actionGrant() {
		
		$this->render('grant');
	}
	
	public function actionAdministrator() {
		
		$this->render('administrator');
	}
	
	public function menuItems() {
		$items = array();
		$items[] = array('label'=>'角色管理');
		$items[] = array('label'=>'角色列表', 'url'=>array('/admin/member/roles'));

		if (trim($_GET['r'], '/') === 'admin/member/modifyRole') {
			$items[] = array('label'=>'修改角色', 'url'=>Yii::app()->request->url, 'active'=>true);
		}else if (trim($_GET['r'], '/') === 'admin/member/deleteRole') {
			$items[] = array('label'=>'删除角色', 'url'=>Yii::app()->request->url, 'active'=>true);
		}else {
			$items[] = array('label'=>'创建角色', 'url'=>array('/admin/member/createRole'));
		}
		
		$items[] = array('label'=>'授权管理');
		$items[] = array('label'=>'授权管理', 'url'=>array('/admin/member/permissions'));
		$items[] = array('label'=>'用户授权', 'url'=>array('/admin/member/grant'));
		
		$items[] = array('label'=>'用户管理');
		$items[] = array('label'=>'用户列表', 'url'=>array('/admin/member/administrator'));
		$items[] = array('label'=>'添加用户', 'url'=>array('/admin/member/administrator'));
		
		return $items;
	}
}
