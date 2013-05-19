<?php
/**
 * SystemController class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

/**
 * Controller for manage system wide settings, avaliable to system administors.
 */
class SystemController extends AdminController {
	
	public $defaultAction = 'website';
	
	public function menuItems() {
		return array(
			array('label'=>'站点信息', 'url'=>array('/admin/system/website')),
			array('label'=>'显示设置', 'url'=>array('/admin/system/show')),
			array('label'=>'Git设置', 'url'=>array('/admin/system/git')),
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
	
	public function actionGit() {
		$model = new SystemGitForm();
		
		if (isset($_POST['SystemGitForm'])) {
			$model->setAttributes($_POST["SystemGitForm"]);
			if ($model->save()) {
				$this->refresh();
			}
		}
		$this->render('git', array(
			'model'=>$model,
		));
	}
}
