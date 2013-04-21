<?php
/**
 * GitBlog class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 * @since 2013-04-19
 */
class GitBlog extends CComponent {
	
	/**
	 * Render a image for display a avatar of a user.
	 * 
	 * @param string        $userOrUid
	 * @param array|string  $size
	 * @param array         $htmlOptions
	 */
	public static function userAvatar($userOrUid = null, $size = 'big', $htmlOptions = array()) {
		if ($userOrUid === null) {
			$userOrUid = Yii::app()->user->getState('user');
		}
		$user = $userOrUid instanceof User ? $userOrUid : User::load($userOrUid);
		if (is_string($size)) {
			$map = array(
				'big' => array(140, 140),
				'medium' => array(80, 80),
				'small' => array(50, 50),
				'tiny' => array(30, 30),
			);
			if (isset($map[$size])) {
				$size = $map[$size];
			}else {
				throw new InvalidArgumentException('Unvalid avatar size value');
			}
		}
		$htmlOptions['src'] = $user->getAvatarUrl($size[0], $size[1]);
		return '<img ' . CHtml::renderAttributes($htmlOptions) .'/>';
	}
	
}
