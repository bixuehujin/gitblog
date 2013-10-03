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
			array('label'=>Yii::t('admin', 'Site information'), 'url'=>array('/admin/system/website')),
			array('label'=>Yii::t('admin', 'Content setting'), 'url'=>array('/admin/system/show')),
			array('label'=>Yii::t('admin', 'Git setting'), 'url'=>array('/admin/system/git')),
			array('label'=>Yii::t('admin', 'Localization setting'), 'url'=>array('/admin/system/localization')),
		);
	}
	
	public function actionWebsite() {
		$model = new SystemWebsiteForm();
		if(isset($_POST['SystemWebsiteForm'])) {
			$model->attributes = $_POST['SystemWebsiteForm'];
			if($model->save()) {
				Yii::app()->console->addSuccess(Yii::t('admin', 'Save configuration success'));
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
				Yii::app()->console->addSuccess(Yii::t('admin', 'Save configuration success'));
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
	
	public function actionLocalization() {
		$this->sectionTitle = Yii::t('admin', 'Localization setting');
		
		$model = new LocalizationForm();
		if (isset($_POST['LocalizationForm'])) {
			$model->setAttributes($_POST['LocalizationForm']);
			if ($model->save()) {
				$this->refresh();
			}
		}
		$this->render('localization', array('model' => $model));
	}
}
