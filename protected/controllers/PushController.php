<?php
/**
 * PushController class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

class PushController extends Controller {
	
	/**
	 * action to receive github hook requests.
	 */
	public function actionCommit() {
		if(!isset($_GET['token']) || ! ($settings = $this->getSettingsByToken($_GET['token']))) {
			echo 'valied request.';
			return;
		}
		$data = isset($_POST['payload']) ? $_POST['payload'] : null;
		if(!$data) {
			echo 'wrong argmuents.';
			return;
		}
		
		$data = json_decode($data);
		
		if(!$this->validateRepo($data, $settings)) {
			return 'wrong repo or branch';
		}
		
		$fieldsMap = array(
			'added'=>'added',
			'modified'=>'modified',
			'removed'=>'removed',
			'timestamp'=>'timestamp',
			'url'=>'url',
			'id'=>'commit_id',
			'message'=>'message',
		);
		foreach ($data->commits as $commit) {
			if($commit) {
				
			}
			try {
				$model = new Commit();
				$model->uid = $settings->uid;
				foreach ($fieldsMap as $gitkey=>$key) {
					$model->$key = $commit->$gitkey;
				}
				$model->save(false);
			}catch (Exception $e) {
				Yii::log("failed to save commit to database.[{$e->getMessage()}]", 'warning', 'application.gitblog');
			}

		}
	}
	
	
	protected function getSettingsByToken($token) {
		return UserSetting::model()->findByAttributes(array('token'=>$token));
	}
	
	/**
	 * validate if a push request is valid according to user settings
	 * 
	 * @param  $pushObj push object form github.
	 * @param  $settings UserSetting form database.
	 * @return bool
	 */
	protected function validateRepo($pushObj, $settings) {
		$repo = $pushObj->repository->name;
		$branch = array_pop(explode('/', $pushObj->ref));
		return $repo == $settings->repository && $branch == $settings->branch;
	}
}