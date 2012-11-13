<?php
/**
 * SitePermissionsBehavior class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.co>
 */

class SitePermissionsBehavior extends CBehavior {

	/**
	 * indicate whether auto rebuild site permissions. if this value is false, 
	 * system settings of 'auto_permissions_rebuld' will be used.
	 * @var boolean
	 */
	public $autoRebuild = false;
	/**
	 * specify extra controller dirs used to rebuild permissions.
	 * @var array
	 */
	public $extraDirs = array();
	/**
	 * @var CDbAuthManager
	 */
	private $auth;
	
	
	public function __construct() {
		$this->auth = Yii::app()->authManager;
	}
	
	/**
	 * declare events this behavior can handle.
	 * 
	 * @see CBehavior::events()
	 */
	public function events() {
		return array(
			'onBeginRequest'=>'BeginRequestHandler',
		);
	}
	
	/**
	 * handler for CWebApplication onBeginRequest event.
	 * 
	 * @param Event $event
	 */
	public function beginRequestHandler($event) {
		$doRebuild = $this->autoRebuild ?: 
			(bool)Yii::app()->systemSettings->get('auto_permissions_rebuld');
		
		if ($doRebuild) {
			$this->rebuild();
		}
	}
	
	/**
	 * rebuild site permissions.
	 * 
	 * In order make rebuild works, every Controller class should implements a method 
	 * named `permissions`, the method should return a array contains permissions information
	 * provided by the Controller. the structure of array is:
	 * <pre>
	 *     array(
	 *         'damain.to.permission'=>array(
	 *             'name'=>'damain.to.permission',
	 *             'description'=>'Description',
	 *             'bizrule'=>'busness rule',
	 *             'data'=>'extra data'
	 *         ),
	 *         ...
	 *     )
	 * </pre>
	 * 
	 * @return boolean
	 */
	public function rebuild() {
		
		$permissions = $this->getPermissions();
		
		$this->savePermissions($permissions);
		return true;
	}
	
	/**
	 * get all permission declared by all controllers.
	 * 
	 * @return array
	 */
	public function getPermissions() {
		$permissions = array();
		$dirs = array_merge(array(
				'controllers',
				'modules'
		), $this->extraDirs);
		
		$classes = $this->getControllerClasses($dirs);
		
		foreach ($classes as $class) {
			require_once $class;
			$className = basename($class, '.php');
			$object = new $className('');
			if (method_exists($object, 'permissions')) {
				$ret = $object->permissions();
				if (is_array($ret)) {
					$this->permissionsFormatCheck($ret);
					$permissions += $ret;
				}
			}
		}
		
		return $permissions;
	}
	
	
	/**
	 * save changed permissions to database.
	 * 
	 * @param array $permissions
	 * @return boolean now always true.
	 */
	protected function savePermissions($permissions) {
		$items = $this->auth->getAuthItems(0);
		$indexedItems = array();
		foreach ($items as $item) {
			$indexedItems[$item->name] = array(
				'name'=>$item->name,
				'description'=>$item->description,
				'bizRule'=>$item->bizRule,
				'data'=>$item->data,
				'auth'=>$item,//instance of this AuthItem
			);
		}
		
		
		$intersection = array_intersect_key($permissions, $indexedItems);
		
		
		$deletionSet = array_diff_key($indexedItems, $permissions);
		$additionSet = array_diff_key($permissions, $indexedItems);
		
		//update exsit permission informations
		foreach ($intersection as $key => $item) {
			$authItem = $indexedItems[$key]['auth'];
			unset($indexedItems[$key]['auth']); // unset the item to compare change.
			if ($item != $indexedItems[$key]) {
				$this->updateAuthItem($authItem, $item);
			}
		}
		//delete none used items
		foreach ($deletionSet as $key => $item) {
			$this->auth->removeAuthItem($key);
		}
		//add new permission items
		foreach ($additionSet as $key => $item) {
			$this->auth->createAuthItem($item['name'], 0, 
				$item['description'], $item['bizRule'], $item['data']);
		}
		
		return true;
	}
	
	/**
	 * check permissions structure and add some default information.
	 * 
	 * @param array $permissions
	 */
	protected function permissionsFormatCheck(&$permissions) {
		foreach ($permissions as $key => &$permission) {
			if (!isset($permission['name'])) {
				$permission['name'] = $key;
			}
			if (!isset($permission['description'])) {
				$permission['description'] = '';
			}
			if (!isset($permission['bizRule'])) {
				$permission['bizRule'] = '';
			}
			if (!isset($permission['data'])) {
				$permission['data'] = NULL;
			}
		}
	}
	
	/**
	 * @param CAuthItem $authItem
	 * @param array $fileds
	 */
	protected function updateAuthItem($authItem, $fileds) {
		if (isset($fileds['name'])) {
			$authItem->name = $fileds['name'];
		}
		if (isset($fileds['description'])) {
			$authItem->description = $fileds['description'];
		}
		if (isset($fileds['bizRule'])) {
			$authItem->bizRule = $fileds['bizRule'];
		}
		if (isset($fileds['data'])) {
			$authItem->data = $fileds['data'];
		}
		$this->auth->saveAuthItem($authItem);
	}
	
	
	/**
	 * get all controller classes by specified search dirs.
	 * 
	 * @param array $dirs search dirs
	 * @return array
	 */
	protected function getControllerClasses($dirs) {
		$classes = array();
		foreach ($dirs as $dir) {
			$classes = array_merge($classes, 
				$this->getControllerClassesRecursively(Yii::app()->basePath . '/' . $dir));
		}
		return $classes;
	}
	
	/**
	 * get controller class files recursively.
	 * 
	 * @param string $path
	 * @return array
	 */
	protected function getControllerClassesRecursively($path) {
		$classes = array();
		$iter = new DirectoryIterator($path);
		foreach ($iter as $file) {
			if ($file->isDot()) {
				continue;
			}
			if ($file->isDir()) {
				$classes = array_merge($classes, 
					$this->getControllerClassesRecursively($file->getPathname()));
			}else {
				$str = substr($file->getBaseName('.php'), -10, 10);
				if(strcmp($str, 'Controller') == 0) {
					$classes[] = $file->getPathname();
				} 
			}
		}
		return $classes;
	}
}
