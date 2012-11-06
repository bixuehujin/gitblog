<?php
/**
 * ActiveReocrd class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

/**
 * user defined ActiveRecord class, implements some helper functions to use in projects.
 */
class ActiveRecord extends  CActiveRecord {
	
	/**
	 * convert a list of ActiveRecord object to a indexed array.
	 * @param array list of ActiveRecord
	 * @param string $keyName 
	 * @param mixed $valueKeys
	 * @return array
	 */
	static public function listToArray($list, $keyName, $valueKeys = null) {
		$ret = array();
		foreach ($list as $item) {
			if($valueKeys == null) {
				$ret[$item[$keyName]] =$item;
			}else{
				foreach ($valueKeys as $key) {
					$ret[$item[$keyName]][$key] = $item[$key];
				}
			}
		}
		return $ret;
	}
}
