<?php
/**
 * Helper class file
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */
class Helper {
	
	/**
	 * helper for debug
	 * 
	 * @param mixed $var
	 */
	static public function print_r($var) {
		echo '<pre>';
		echo print_r($var);
		echo '</pre>';
	}
	
}
