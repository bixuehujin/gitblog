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
		$user = Yii::app()->user->getState('user');
		$uid = $user->uid;
		FileUsage::removeAllAttached($uid, 'user');
		if (FileUsage::add($uid, 'user', $file)) {
			$user->avatar = $file->fid;
			$user->save(false, array('avatar'));
			Yii::app()->console->addSuccess('上传头像成功');
			return true;
		}else {
			Yii::app()->console->addError('上传头像失败');
			return false;
		}
	}
}
