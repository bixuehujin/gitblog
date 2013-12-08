<?php
use ecom\image\model\ImageManaged;
/**
 * AcatarForm class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 * @since 2013-04-19
 */

class AvatarForm extends CFormModel {
	
	/**
	 * Upload avatar and save to database.
	 * 
	 * @return boolean
	 */
	public function save() {
		
		$fileManaged = Yii::app()->fileManager->createManagedObject('avatar');
		
		$uploadedFile = CUploadedFile::getInstanceByName('files[avatar]');
		
		if (!$uploadedFile) {
			Yii::app()->console->addError(Yii::t('view', 'No file uploaded'));
			return false;
		}
		
		$newFile = $fileManaged->upload($uploadedFile);
		if (!$newFile) {
			Yii::app()->console->addError(Yii::t('view', $fileManaged->getUploadError()));
			//$this->addError('', $fileManaged->getUploadError());
			return false;
		}
		
		$user = User::load(Yii::app()->user->getId());
		$uid = $user->uid;
		
		if ($user->avatar && $oldImage = ImageManaged::load($user->avatar)) {
			$oldImage->detach($user);
		}

		if ($newFile->attach($user)) {
			$user->avatar = $newFile->fid;
			$user->save(false, array('avatar'));
			Yii::app()->user->setState('user', $user);
			Yii::app()->console->addSuccess(Yii::t('view', 'Upload avatar success'));
			return true;
		}else {
			Yii::app()->console->addError(Yii::t('view', 'Upload avatar failed'));
			return false;
		}
	}
}
