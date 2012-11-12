<?php
/**
 * PersistentMessage class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

/**
 * Persistent message, provide saving messages in session, enable show messages in 
 * muti pages.
 *
 * @property array persistentErrors
 * @property array persistentInfos
 * @property array persistentWarning
 * @property array persistentSuccesses
 * @property boolean hasMessages
 */
class PersistentMessage extends CApplicationComponent {
	
	const TYPE_ERROR 	= 'error';
	const TYPE_SUCCESS 	= 'success';
	const TYPE_INFO		= 'info';
	const TYPE_WARNING 	= 'warning';
	/**
	 * instance of CHttpSeccion
	 * @var CHttpSession
	 */
	private $_session;
	/**
	 * reference to $_SESSION[$this->sessionKey]
	 * @var array
	 */
	private $_messages;
	/**
	 * index used to store infomation to $_SESSION
	 * @var string
	 */
	public $sessionKey;
	
	/**
	 * initalizes variables.
	 */
	public function __construct() {
		$this->_session = Yii::app()->session;
		if($this->sessionKey === null) {
			$this->sessionKey = __CLASS__;
		}
		$this->_messages = &$this->getStorage();
	}
	
	
	/**
	 * get a reference of session storage.
	 * 
	 * @return array
	 */
	protected function &getStorage() {
		if (!($message = $this->_session->get($this->sessionKey, false))) {
			$this->_session->add($this->sessionKey, array());
		}
		return $_SESSION[$this->sessionKey];
	}
	
	/**
	 * add a message to session.
	 * 
	 * @param string $message
	 * @param string $type
	 */
	public function addPersistentMessage($message, $type = self::TYPE_SUCCESS) {
		$this->_messages[$type][] = $message;
	}
	
	/**
	 * remove all or a certain type of persistent messages.
	 * 
	 * @param mixed $type the type of messages to remove, null for all
	 */
	public function removePersistentMessages($type = null) {
		
		if ($type === null) {
			$this->_messages = array();
		}else {
			unset($this->_messages[$type]);
		}
	}
	
	/**
	 * get all or a certain type of persistent messages.
	 * 
	 * @param mixed $type the type of messages to get, null for all
	 * @return array
	 */
	public function getPersistentMessages($type = null){
		
		$ret = array();
		if($type == null) {
			$ret = $this->_messages;
		}
		if(isset($this->_messages[$type])) {
			$ret = $this->_messages[$type];
		}
		
		$this->removePersistentMessages($type);
		return $ret;
	}
	
	/**
	 * add persistent error message.
	 * 
	 * @param string $message
	 */
	public function addPersistentError($message) {
		$this->addPersistentMessage($message, self::TYPE_ERROR);
	}
	
	/**
	 * get all error messages.
	 * 
	 * @return array
	 */
	public function getPersistentErrors() {
		return $this->getPersistentMessages(self::TYPE_ERROR);
	}
	
	/**
	 * addd persistent info message.
	 * 
	 * @param string $message
	 */
	public function addPersistentInfo($message) {
		$this->addPersistentMessage($message, self::TYPE_INFO);
	}
	
	/**
	 * get persistent info messages.
	 * 
	 * @return array
	 */
	public function getPersistentInfos() {
		return $this->getPersistentMessages(self::TYPE_INFO);
	}
	
	/**
	 * add persistent warning message.
	 * 
	 * @param string $message
	 */
	public function addPersistentWarning($message) {
		$this->addPersistentMessage($message, self::TYPE_WARNING);
	}
	
	/**
	 * get persistent warning messages.
	 * 
	 * @return array
	 */
	public function getPersistentWarnings() {
		return $this->getPersistentMessages(self::TYPE_WARNING);
	}
	
	/**
	 * add persistent success message.
	 * 
	 * @param string $message
	 */
	public function addPersistentSuccess($message) {
		$this->addPersistentMessage($message, self::TYPE_SUCCESS);
	}
	
	/**
	 * get persistent success messages.
	 * 
	 * @return array
	 */
	public function getPersistentSuccesses() {
		return $this->getPersistentMessages(self::TYPE_SUCCESS);
	}
	
	/**
	 * get the number of error messages.
	 * 
	 * @return number
	 */
	public function persistentErrorCount() {
		return isset($this->_messages[self::TYPE_ERROR])
			? count($this->_messages[self::TYPE_ERROR]) : null;
	}
	
	/**
	 * get the number of success messages.
	 *
	 * @return number
	 */
	public function persistentSuccessCount() {
		return isset($this->_messages[self::TYPE_SUCCESS]) 
			? count($this->_messages[self::TYPE_SUCCESS]) : null;
	}
	
	/**
	 * get the number of warning messages.
	 *
	 * @return number
	 */
	public function persistentWarningCount() {
		return isset($this->_messages[self::TYPE_WARNING])
			? count($this->_messages[self::TYPE_WARNING]) : null;
	}
	
	/**
	 * get the number of info messages.
	 *
	 * @return number
	 */
	public function persistentInfoCount() {
		return isset($this->_messages[self::TYPE_INFO])
			? count($this->_messages[self::TYPE_INFO]) : null;
	}
	
	/**
	 * whether have message.
	 * 
	 * @return boolean
	 */
	public function getHasMessages() {
		return !empty($this->_messages);
	}
	
	/**
	 * render messages to HTML.
	 * 
	 * @param array $options array indexed by error, warning, info, success. 
	 * the value is html options used to render messages widgets.
	 */
	public function renderMessages($options = array()) {
		$ret = '';
		if ($this->persistentSuccessCount()) {
			$ret .= $this->_renderMessage($this->getPersistentSuccesses(), 'success',
				isset($options['success']) ? $options['success'] : array());
		}
		if ($this->persistentInfoCount()) {
			$ret .= $this->_renderMessage($this->getPersistentInfos(), 'info',
				isset($options['info']) ? $options['info'] : array());
		}
		if($this->persistentWarningCount()) {
			$ret .= $this->_renderMessage($this->getPersistentWarnings(), 'warning',
				isset($options['warning']) ? $options['warning'] : array());
		}
		if($this->persistentErrorCount()) {
			$ret .= $this->_renderMessage($this->getPersistentErrors(), 'error',
				isset($options['error']) ? $options['error'] : array());
		}
		return $ret;
	}
	
	private function _renderMessage($messages, $type, $htmlOptions = array()) {
		if (!isset($htmlOptions['class'])) {
			$htmlOptions['class'] = 'alert alert-' . $type;
		}
		$html = CHtml::openTag('div', $htmlOptions);
		if (count($messages) > 1) {
			$html .= CHtml::openTag('ul');
			foreach ($messages as $message) {
				$html .= '<li>' . $message . '</li>';
			}
			$html .= '</ul>';
		}else {
			$html .= array_shift($messages);
		}
		return $html . '</div>';
	}
}
