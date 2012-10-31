<?php
/**
 * controller for manage system wide settings, avaliable to system administor.
 * 
 * @author hujin
 *
 */
class SystemController extends AdminController {
	
	public $defaultAction = 'website';
	
	public function menuItems() {
		return array(
			array('label'=>'站点信息', 'url'=>array('/admin/system/website')),
			array('label'=>'显示设置', 'url'=>array('/admin/system/show')),
		);
	}
	
	public function actionWebsite() {
		$model = new SystemWebsiteForm();
		if(isset($_POST['SystemWebsiteForm'])) {
			$model->attributes = $_POST['SystemWebsiteForm'];
			if($model->save()) {
				Yii::app()->sessionMessager->addMessage('修改成功', 'success');
				$this->refresh();
			}
		}
		$this->render('website', array(
			'model'=>$model,
		));
	}
	
	public function actionShow() {
		$model = new SystemShowForm();
		
		if(isset($_POST['SystemShowForm'])) {
			$model->attributes = $_POST['SystemShowForm'];
			if($model->save()) {
				Yii::app()->sessionMessager->addMessage('保存成功', 'success');
				$this->refresh();
			}
		}
		
		$this->render('show', array(
				'model'=>$model,
		));
	}
}