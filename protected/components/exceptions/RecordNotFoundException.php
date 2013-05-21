<?php
/**
 * RecordNotFoundException class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

/**
 * In some cases, we need find a record form database and the do some stuff. 
 * But when the record do not found, error occured. In order to leave the error
 * handled by caller, we can use the Exception.
 * 
 */
class RecordNotFoundException extends CException {
	
}
