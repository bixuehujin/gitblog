<?php
/**
 * LocalizationController class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

class LocalizationController extends AdminController {
	
	public $defaultAction = 'regional';
	
	
	public function actionRegional() {
		$this->sectionTitle = Yii::t('admin', 'Regional settings');
		
		$model = new RegionalForm();
		if (isset($_POST['RegionalForm'])) {
			$model->setAttributes($_POST['RegionalForm']);
			if ($model->save()) {
				$this->refresh();
			}
		}
		$this->render('regional', array('model' => $model));
	}
	
	public function actionDateTime() {
		
		$this->render('datetime');
	}
	
	public function actionLanguages() {
		
		$this->render('languages');
	}
	
	public function menuItems() {
		return array(
			array('label'=>Yii::t('admin', 'Regional settings'), 'url'=>array('/admin/localization/regional')),
			array('label'=>Yii::t('admin', 'Date and time'), 'url'=>array('/admin/localization/datetime')),
			array('label'=>Yii::t('admin', 'Languages'), 'url'=>array('/admin/localization/Languages')),
		);
	}
}
