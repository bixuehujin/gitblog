<?php
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
		$file = FileManaged::model();
		$file->setAllowExtensions('jpg|png|gif');
		if (!$file->upload('avatar', 'avatar', FileManaged::STATUS_PERSISTENT)) {
			$this->addErrors($file->getErrors());
			return false;
		}
		$user = User::load(Yii::app()->user->getId());
		$uid = $user->uid;
		FileUsage::removeAllAttached($uid, 'user');
		if (FileUsage::add($uid, 'user', $file)) {
			$user->avatar = $file->fid;
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
