<?php
/**
 * 
 * @author hujin
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
}