<?php
/**
 * DbAuthManager class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

class DbAuthManager extends CDbAuthManager {
	/**
	 * @var string the name of the table storing authorization items. Defaults to 'AuthItem'.
	 */
	public $itemTable='auth_item';
	/**
	 * @var string the name of the table storing authorization item hierarchy. Defaults to 'AuthItemChild'.
	 */
	public $itemChildTable='auth_item_child';
	/**
	 * @var string the name of the table storing authorization item assignments. Defaults to 'AuthAssignment'.
	 */
	public $assignmentTable='auth_assignment';
	
	/**
	 * check whether a user can perform an operaion. if the user id is 1, the function 
	 * will always return true.
	 * 
	 * @see CDbAuthManager::checkAccess()
	 */
	public function checkAccess($itemName, $userId, $params = array()) {
		if ($userId == 1) {
			return true;
		}
		return parent::checkAccess($itemName, $userId, $params);
	}
}
