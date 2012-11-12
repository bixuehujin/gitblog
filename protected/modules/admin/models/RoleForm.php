<?php
/**
 * RoleForm class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

class RoleForm extends CFormModel {
	
	const SCENARIO_CREATE = 'create';
	const SCENARIO_MODIFY = 'modify';
	const SCENARIO_DELETE = 'delete';
	
	public $name;
	public $description;
	

	public function init() {
		if (empty($this->scenario)) {
			$this->scenario = self::SCENARIO_CREATE;
		}
	}
	
	/**
	 * load data from database by name.
	 * 
	 * @param string $name
	 */
	public function loadByName($name) {
		$item = Yii::app()->authManager->getAuthItem($name);
		if (!$item) {
			throw new CHttpException(404);
		}
		$this->name = $item->name;
		$this->description = $item->description;
	}
	
	public function rules(){
		return array(
			array('name', 'required'),
			array('description', 'required'),
		);
	}
	
	public function attributeLabels() {
		return array(
			'name'=>'角色名称',
			'description'=>'角色描述',
		);
	}
	
	
	public function validateSave() {
		if (!parent::validate()) {
			return false;
		}
		
		if ($this->scenario == self::SCENARIO_CREATE) {
			if ((bool) Yii::app()->authManager->getAuthItem($this->name)) {
				$this->addError('name', '该角色已存在');
				return false;
			}
		}
		return true;
	}
	
	public function validateUpdate($name) {
		if (!parent::validate()) {
			return false;
		}
		
		if ($this->scenario == self::SCENARIO_MODIFY) {
			if ( Yii::app()->authManager->getAuthItem($this->name) && $name != $this->name) {
				$this->addError('name', '该角色已存在');
				return false;
			}
		}
		return true;
	}
	
	/**
	 * save a new record to database.
	 * 
	 * @return boolean
	 */
	public function save() {
		$ret = false;
		if ($this->validateSave()) {
			$ret = (bool)Yii::app()->authManager->createAuthItem($this->name, 2, $this->description);
			if ($ret) {
				Yii::app()->persistentMessage->addPersistentSuccess('创建角色成功');
			}
		}
		return $ret;
	}
	
	/**
	 * update a exsit role via role name.
	 * 
	 * @param string $name
	 * @return boolean
	 */
	public function update($name) {
		if ($this->validateUpdate($name)) {
			$auth = Yii::app()->authManager->getAuthItem($name);
			$auth->name = $this->name;
			$auth->description = $this->description;
			
			Yii::app()->authManager->saveAuthItem($auth, $name);
			Yii::app()->persistentMessage->addPersistentSuccess('修改角色成功');
			return true;
		}else {
			return false;
		}
	}
	
	/**
	 * delete a role
	 * 
	 * @return boolean
	 */
	public function delete() {
		$ret = (bool)Yii::app()->authManager->removeAuthItem($this->name);
		if($ret) {
			Yii::app()->persistentMessage->addPersistentSuccess('删除角色成功');
		}
		return $ret;
	}
}
