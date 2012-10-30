<?php
class SessionMessager extends CApplicationComponent {
	
	private $_msgs;
	private $_session;
	
	public function init() {
		$this->_session = Yii::app()->session;
		if(!$this->_session->get('SessionMessager')) {
			$this->_session->add('SessionMessager', array());
		}
		
		$this->_msgs = &$_SESSION['SessionMessager'];
	}
	
	/**
	 * 
	 * @param string $msg
	 * $param string $type one of success, error ,info, danger
	 */
	public function addMessage($msg, $type = 'info', $options = array()) {
		$msg = array(
			'msg' => $msg,
			'type' => $type
		);
		$msg += $options;
		$this->_msgs[] = $msg;
		return $this;
	}
	
	
	public function renderMessageWidget() {
		if (empty($this->_msgs)) {
			return '';
		}
		$out = '';
		foreach ($this->_msgs as $msg) {
			$out .= $this->_render($msg);
		}
		$this->clearMessages();
		return $out;
	}
	
	/**
	 * reder single message
	 * @param array $msg
	 */
	private function _render($msg) {
		$out = "<div {$this->_renderAttributes($msg)}>";
		$out .= $msg['msg'];
		$out .= '</div>';
		return $out;
	}
	
	private function _renderAttributes($msg) {
		if (isset($msg['classes'])) {
			$classes = $msg['classes'];
		}
		$classes[] = 'alert';
		$classes[] = 'alert-' . $msg['type'];
		$str = 'class="' . implode(' ', $classes) . '"';
		unset($msg['classes']);
		unset($msg['type']);
		unset($msg['msg']);
		
		foreach ($msg as $attr => $value) {
			$str .= " $attr=\"$value\"";
		}
		return $str;
	}
	
	public function clearMessages() {
		$_SESSION['SessionMessager'] = array();
		return $this;
	}
}