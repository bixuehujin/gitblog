<?php
/**
 * StaticCache class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

class StaticCache extends CComponent{
	
	static private $_cache = array();
	static private $_instances = array();
	
	private $_ident;
	private $_currCache;
	
	private function __construct($ident) {
		$this->_ident = $ident;
		$this->_currCache = &self::$_cache[$ident];
	}
	
	private function __clone(){
	}
	
	/**
	 * 
	 * @param string $ident
	 * @return StaticCache
	 */
	public static function getInstance($ident) {
		if(!isset(self::$_instances[$ident])) {
			$instance = new StaticCache($ident);
		}
		return self::$_instances[$ident] = $instance;
	}
	
	
	/**
	 * Set a value to cache.
	 * 
	 * @param string $key
	 * @param mixed  $value
	 * @return boolean
	 */
	public function set($key, $value) {
		$this->_currCache[$key] = $value;
		return true;
	}
	
	/**
	 * Get a value by key from cache.
	 * 
	 * @param string $key
	 * @return mixed
	 */
	public function get($key) {
		if (isset($this->_currCache[$key])) {
			return $this->_currCache[$key];
		}
		return null;
	}
	
	/**
	 * Check whether a key is cached.
	 * 
	 * @param string $key
	 * @return boolean
	 */
	public function exists($key) {
		return isset($this->_currCache[$key]);
	}
	
	
	/**
	 * Remove a value by key from cache.
	 * 
	 * @param string $key
	 * @return boolean
	 */
	public function remove($key) {
		if (isset($this->_currCache[$key])) {
			unset($this->_currCache[$key]);
			return true;
		}
		return false;
	}
	
	/**
	 * Clear all cached keys of current object.
	 */
	public function clear() {
		$this->_currCache = array();
	}
	
	/**
	 * Get multiple values by keys.
	 * 
	 * @param array $keys
	 * @return array indexed by its key.
	 */
	public function mget($keys) {
		if(empty($keys)) {
			return array();
		}
		$ret = array();
		foreach($keys as $key) {
			if (isset($this->_currCache[$key])) {
				$ret[$key] = $this->_currCache[$key];
			}else {
				$ret[$key] = null;
			}
		}
		return $ret;
	}
	
	/**
	 * Add a key=>value pairs to cache.
	 * 
	 * @param string $key
	 * @param mixed  $value
	 * @return boolean
	 */
	public function add($key, $value) {
		if(!isset($this->_currCache[$key])) {
			$this->_currCache[$key] = $value;
		}
		return true;
	}
	
}
