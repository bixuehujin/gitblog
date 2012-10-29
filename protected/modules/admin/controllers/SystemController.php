<?php
/**
 * controller for manage system wide settings, avaliable to system administor.
 * 
 * @author hujin
 *
 */
class SystemController extends AdminController {
	
	public $defaultAction = 'website';
	
	public function actionWebsite() {
		$model = new GlobalForm();
		if(isset($_POST['GlobalForm'])) {
			$model->attributes = $_POST['GlobalForm'];
			if($model->save()) {
				Yii::app()->sessionMessager->addMessage('修改成功', 'success');
			}else {
				Yii::app()->sessionMessager->addMessage('修改失败', 'error');
			}
			$this->refresh();
		}
		$this->render('website', array('model'=>$model));
	}
}