<?php
/**
 * SourceController class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

class SourceController extends AdminController {
	
	public $defaultAction = 'basic';
	
	public function actionBasic() {
		$contentSetting = new ContentSettingForm();
		
		if(isset($_POST['ContentSettingForm'])) {
			$contentSetting->attributes = $_POST['ContentSettingForm'];
			if($contentSetting->save()) {
				Yii::app()->sessionMessager->addMessage('保存设置成功', 'success');
			}else {
				Yii::app()->sessionMessager->addMessage('保存设置失败', 'error');
			}
			$this->refresh();
		}
		
		$this->render('basic', array(
			'contentSetting' => $contentSetting,
		));
	}
	
	/**
	 * github hook configure page
	 */
	public function actionHook() {
		$model = new SourceHookForm();
		
		if (isset($_POST['SourceHookForm'])) {
			if ($model->generate()) {
				Yii::app()->sessionMessager->addMessage('生成Token成功', 'success');
			}else {
				Yii::app()->sessionMessager->addMessage('生成Token失败', 'error');
			}
			$this->refresh();
		}
		
		$this->render('hook', array(
			'model' => $model,
		));
	}
	
	public function menuItems() {
		return array(
			array('label'=>'内容设定', 'url'=>array('/admin/source/basic')),
			array('label'=>'Github Hook', 'url'=>array('/admin/source/hook')),
		);
	}
}
