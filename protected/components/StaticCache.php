<?php

/**
 * use PHP static variable to cache data.
 * @author hujin
 *
 */
class StaticCache {
	static private $_cache = array();
	static private $_instance;
	static private $_ident;
	
	private function __construct() {
		
	}
	
	private function __clone(){
		
	}
	
	/**
	 * 
	 * @param string $ident
	 * @return StaticCache
	 */
	static public function getInstance($ident) {
		if(!isset(self::$_instance)) {
			self::$_instance = new StaticCache();
		}
		self::$_ident = $ident;
		return self::$_instance;
	}
	
	
	protected function getUniqeKey($key) {
		return self::$_ident . $key;
	}
	
	public function set($key, $value) {
		self::$_cache[$key] = $value;
		return true;
	}
	
	public function get($key) {
		$ukey = $this->getUniqeKey($key);
		if (isset(self::$_cache[$ukey])) {
			return self::$_cache[$ukey];
		}
		return null;
	}
	
	public function mget($keys) {
		if(empty($keys)) {
			return array();
		}
		$ret = array();
		foreach($keys as $key) {
			$ukey = $this->getUniqeKey($key);
			if (isset(self::$_cache[$ukey])) {
				$ret[$key] = self::$_cache[$ukey];
			}else {
				$ret[$key] = null;
			}
		}
		return $ret;
	}
	
	public function add($key, $value) {
		$ukey = $this->getUniqeKey($key);
		if(!isset(self::$_cache[$ukey])) {
			self::$_cache[$ukey] = $value;
		}
		return true;
	}
	
}