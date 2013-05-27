<?php
/**
 * PasswordResetForm class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

class PasswordResetForm extends CFormModel {
	
	public $email;
	
	public function rules() {
		return array(
			array('email', 'required'),
			array('email', 'email'),
		);
	}
	
	public function attributeLabels() {
		return array(
			'email' => '电子邮件',
		);
	}
	
	/**
	 * Reset the password.
	 */
	public function reset() {
		$app = Yii::app();
		$console = $app->getComponent('console');
		if (!$this->validate()) {
			$console->addModel($this);
			return false;
		}
		
		$token = User::generateResetPasswordToken($this->email);
		if (!$token) {
			$console->addError('发送密码重置邮件失败，请检查邮箱是否输入正确');
			return false;
		}
		
		$subject = '仁风的博客 密码重置';
		$content = '点击如下连接完成重置: {url} .';
		$url = $app->controller->createAbsoluteUrl('/site/reset', array('token' => $token));
		$content = strtr($content, array('{url}' => $url));
		$message = $app->mailgun->createMessage();
		$message->setSubject($subject)->setContent($content, true)->addRecipient($this->email);
		if (!$app->mailgun->send($message)) {
			$app->console->addError('发送邮件失败，请稍后再试!');
			return false;
		}
		$app->console->addSuccess('密码重置邮件发送成功，请检查邮箱');
		return true;
	}
}
