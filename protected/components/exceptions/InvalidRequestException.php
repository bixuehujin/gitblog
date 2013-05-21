<?php
/**
 * InvalidRequestException class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

/**
 * The exception is used catch invalid get/post arguments. For example: a
 * ActiveForm need a $_GET['id'] to works, when the 'id' is not defined, 
 * we can throw a InvalidRequestException.
 *
 */
class InvalidRequestException extends CException {
	
	public function __construct($message=null,$code=0) {
		parent::__construct($message, $code);	
	}
}
