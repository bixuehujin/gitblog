<?php
/**
 * CheckBoxColumn class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

/**
 * custom CheckBoxColumn class provide more features.
 */
class CheckBoxColumn extends CCheckBoxColumn {
	/**
	 * the key in data column will be used in checkbox name attribute.
	 * @var string
	 */
	public $keyName;
	/**
	 * 
	 * @var string
	 */
	public $keyValue;
	/**
	 * form the checkbox associated.
	 * @var mixed
	 */
	public $form;
	
	/**
	 * Renders the data cell content.
	 * This method renders a checkbox in the data cell.
	 * @param integer $row the row number (zero-based)
	 * @param mixed $data the data associated with the row
	 * 
	 * @TODO improve needed.
	 */
	protected function renderDataCellContent($row,$data){
		
		$form = is_object($this->form) ? get_class($this->form) : (string)$this->form;
		
		if ($this->keyValue) {
			$key = $this->evaluateExpression($this->keyValue, array('data'=>$data, 'row'=>$row));
		}else if ($this->keyName) {
			$key = CHtml::value($data, $this->keyName);
		}else {
			$key = $this->grid->dataProvider->keys[$row];
		}

		if ($form && is_array($key)) {
			$key = $form . '[' . implode('][', $key) . ']';
		}elseif (is_array($key)) {
			$first = array_shift($key);
			$key = $first . '[' . implode('][', $key) . ']';
		}else {
			$key = $form . $key;
		}
		
		$this->checkBoxHtmlOptions['name'] = $key;
		
		parent::renderDataCellContent($row, $data);
	}
}
