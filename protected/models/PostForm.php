<?php
/**
 * PostForm class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 * @since 2013-05-11
 */

class PostForm extends CFormModel {
	
	public $path;
	public $content;
	public $commit;
	
	public function attributeLabels() {
		return array(
			'path' => '保存路径',
			'content' => '内容',
			'commit' => 'Commit信息',
		);
	}
	
	public function rules() {
		return array(
			array('content,commit,path', 'required'),
		);
	}
	
	public function save() {
		
		
		if (!$this->validate()) {
			Yii::app()->console->addModel($this);
			return false;
		}
		
		$path = realpath(Yii::getPathOfAlias('application') . '/../repo/githook-test');
		$client = new GitClient($path);
		$parent = $client->createAndCommit($this->content, $this->path, $this->commit);
		if ($parent) {
			Yii::app()->console->addSuccess('成功');;
		}else {
			Yii::app()->console->addError('失败');;
		}
		return true;
	} 	
}
