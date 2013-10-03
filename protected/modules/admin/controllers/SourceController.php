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
				Yii::app()->console->addSuccess(Yii::t('admin', 'Save configuration success'));
			}else {
				Yii::app()->console->addError(Yii::t('admin', 'Save configuration failed'));
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
				Yii::app()->console->addSuccess('生成Token成功');
			}else {
				Yii::app()->console->addError('生成Token失败');
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
