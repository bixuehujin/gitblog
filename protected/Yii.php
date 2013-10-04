<?php
/**
 * Yii bootstrap file.
 *
 * @author Jin Hu <bixuehujin@gmail.com>
 */

class Yii extends YiiBase {

	/**
	 * Creates an object and initializes it based on the given configuration.
	 * 
	 * Different with the parent one, this method will not try to import namesapced class.
	 * 
	 * @param mixed $config
	 * @throws CException
	 */
	public static function createComponent($config) {
		if(is_string($config)) {
			$type = $config;
			$config = array();
		}elseif (isset($config['class'])) {
			$type = $config['class'];
			unset($config['class']);
		}else {
			throw new CException(Yii::t('yii','Object configuration must be an array containing a "class" element.'));
		}
		
		if(strpos($type, '\\') === false && !class_exists($type, false)) {
			$type = Yii::import($type, true);
		}
		
		if(($n = func_num_args()) > 1) {
			$args = func_get_args();
			unset($args[0]);
			$class=new ReflectionClass($type);
			// Note: ReflectionClass::newInstanceArgs() is available for PHP 5.1.3+
			// $object=$class->newInstanceArgs($args);
			$object=call_user_func_array(array($class,'newInstance'),$args);
		}else {
			$object = new $type;
		}
		foreach($config as $key => $value) {
			$object->$key = $value;
		}
		return $object;
	}
}
