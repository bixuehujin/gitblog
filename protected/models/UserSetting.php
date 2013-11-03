<?php
/**
 * UserSetting AR class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

/**
 * 
 * @property integer $uid
 * @property string  $name
 * @property mixed   $value
 */
class UserSetting extends CActiveRecord {
	
	/**
	 * @var StaticCache
	 */
	private $cache;
	
	/**
	 * @return UserSetting
	 */
	public static function model($className = __CLASS__) {
		return parent::model($className);
	}
	
	public function tableName() {
		return 'user_setting';
	}
	
	
	public function beforeSave() {
		$this->value = serialize($this->value);
		return parent::beforeSave();
	}
	
	public function afterFind() {
		$this->value = unserialize($this->value);
		return parent::afterFind();
	}

	protected function getCache() {
		if ($this->cache === null) {
			$this->cache = StaticCache::getInstance(__CLASS__);
		}
		return $this->cache;
	}
	
	protected function resolveUid($user) {
		if ($user == null) {
			$uid = Yii::app()->user->getId();
		}else if ($user instanceof User) {
			$uid = $user->uid;
		}else {
			$uid = $user;
		}
		return $uid;
	}
	
	/**
	 * Get user setting value by name.
	 * 
	 * @param string $name
	 * @param mixed  $user
	 * @return mixed
	 */
	public function get($name, $user = null) {
		$uid = $this->resolveUid($user);
		$key = $uid . ':' . $name;
		$value = $this->getCache()->get($key);
		if ($value === null) {
			$model = $this->findByPk(array(
				'uid' => $uid,
				'name' => $name,
			));
			if ($model) {
				$value = $model->value;
			}
		}
		$this->getCache()->set($key, $value);
		return $value;
	}
	
	/**
	 * Check whether a name of setting is exists.
	 * 
	 * @param string $name
	 * @param mixed  $user
	 * @return boolean
	 */
	public function checkExists($name, $user = null) {
		$uid = $this->resolveUid($user);
		$key = $uid . ':' . $name;
		if ($this->getCache()->exists($key)) {
			return true;
		}
		
		$model = $this->findByPk(array(
			'uid' => $uid,
			'name' => $name,
		));
		if ($model) {
			$this->getCache()->set($key, $model->value);
		}
		return false;
	}
	
	/**
	 * Set a user setting by name.
	 * 
	 * @param string $name
	 * @param mixed  $value
	 * @param mixed  $user
	 * @return boolean
	 */
	public function set($name, $value, $user = null) {
		$uid = $this->resolveUid($user);
		$key = $uid . ':' . $name;
		
		$model = $this->findByPk(array(
			'uid' => $uid,
			'name' => $name
		));
		
		$success = false;
		if ($model) {
			$model->value = $value;
			$success = $model->save(false, array('value'));
		}else {
			$model = new self();
			$model->uid = $uid;
			$model->name = $name;
			$model->value = $value;
			$success = $model->save(false);
		}
		
		if ($success) {
			$this->getCache()->set($key, $value);
			return true;
		}
		return false;
	}
	
	public function create($name, $value, $uid = null) {
		$setting = new self();
		$setting->uid = $uid ?: Yii::app()->user->getId();
		$setting->name = $name;
		$setting->value = $value;
		$setting->save(false);
		return $setting;
	}
}
