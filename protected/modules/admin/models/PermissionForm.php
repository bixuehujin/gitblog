<?php
/**
 * PermissionForm class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

/**
 * this class do not use CModel's setAttributes and getAttributes implements, but override and 
 * implements a new one.
 * 
 * @property CArrayDataProvider $dataProvider data provoder for render gridview.
 * @property array columns columns for render gridview.
 */
class PermissionForm extends  CFormModel {
	
	public $dataProvider;
	public $columns;
	
	private $_attributes;
	private $auth;
	
	public function init() {
		$this->auth = Yii::app()->authManager;
		
		$this->generateData();		
	}
	
	/**
	 * generate data used for render GridView.
	 */
	protected function generateData() {
		
		$permissions = $this->auth->getAuthItems(0);
		$roles = $this->auth->getAuthItems(2);
		
		$data = array();
		$i = 0;
		foreach ($permissions as $permission) {
			$data[$i] = array(
					'name'=>$permission->name,
					'id'=>$permission->name,
					'description'=>$permission->description,
			);
			foreach ($roles as $role) {
				$data[$i][$role->name] = array(
					'granted' => $this->auth->hasItemChild($role->name, $permission->name) ? 1 : 0,
					'nameKey' => array($permission->name, $role->name),
				);
			}
			$i ++;
		}
		
		$this->dataProvider = new CArrayDataProvider($data);
		
		
		$columns = array(Yii::t('admin', 'name::Permission Name'),Yii::t('admin', 'description::Description'));
		foreach ($roles as $role) {
			$columns[] = array(
					'class'=>'CheckBoxColumn',
					'value'=>'1',
					'header'=>Yii::t('admin', $role->name),
					'checked'=>"\$data['{$role->name}']['granted']",
					'selectableRows'=>1,
					'form'=>$this,
					'keyValue'=>"\$data['{$role->name}']['nameKey']",
			);
		}
		
		$this->columns = $columns;
	}
	
	
	/**
	 * clear all permissions associated to all roles.
	 */
	protected function clearPermissions() {
		$roles = $this->auth->getAuthItems(2);
		foreach($roles as $role) {
			$permissions = $this->auth->getItemChildren($role->name);
			foreach($permissions as $permission) {
				$this->auth->removeItemChild($role->name, $permission->name);
			}
		}
	}
	
	public function save() {
		//$this->auth->
		$this->clearPermissions();
		foreach ($this->attributes as $permission=>$roles) {
			foreach ($roles as $role => $value) {
				if(!$this->auth->addItemChild($role, $permission)) {
					
				}
			}
		}
		Yii::app()->console->addSuccess(Yii::t('admin', 'Permission saved success'));
		return true;
	}
	
	
	public function setAttributes($values, $safeOnly = true) {
		$this->_attributes = $values;
	}
	
	public function getAttributes($names = null) {
		return $this->_attributes;
	}
}
