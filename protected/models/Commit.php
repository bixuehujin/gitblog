<?php
/**
 * Commit model class file
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

class Commit extends CActiveRecord {
	/**
	 * the commit have not be preformed, this the default status.
	 */
	const STATUS_NOT_PREFORM = 0;
	/**
	 * the commit had be preformed but failed, need preform again.
	 */
	const STATUS_FAILED = 1;
	/**
	 * everything is ok.
	 */
	const STATUS_SUCCEED = 2;
	
	static public function model($className = __CLASS__) {
		return parent::model($className);
	}
	
	public function tableName() {
		return 'commit';
	}
	
	public function relations() {
		return array(
			'userSettings'=>array(self::HAS_ONE, 'UserSetting', array('uid'=>'uid')),
		);
	}
	
	public function afterFind() {
		$this->added = unserialize($this->added);
		$this->removed = unserialize($this->removed);
		$this->modified = unserialize($this->modified);
		$this->extra = unserialize($this->extra);
		return parent::afterFind();
	}
	
	public function beforeSave() {
		$this->added = serialize($this->added);
		$this->removed = serialize($this->removed);
		$this->modified = serialize($this->modified);
		$this->extra = serialize($this->extra);
		return parent::beforeSave();
	}
	
	
}