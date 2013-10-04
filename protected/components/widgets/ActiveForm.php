<?php
/**
 * ActiveForm class file.
 * @author Jin Hu <bixuehujin@gmail.com>
 */

Yii::import('bootstrap.widgets.TbActiveForm');
Yii::import('bootstrap.widgets.TbAlert');

/**
 * custom ActiveForm implements provide some extra features.
 */
class ActiveForm extends TbActiveForm {
	
	
	/**
	 * render messages
	 * 
	 * @param FormModel $model
	 */
	public function summary($models, $header = null, $footer = null, $htmlOptions = array()) {
		Yii::app()->console->render();
		return parent::errorSummary($models, $header, $footer, $htmlOptions);
	}
}