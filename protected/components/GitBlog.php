<?php
/**
 * GitBlog class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 * @since 2013-04-19
 */
class GitBlog extends CComponent {
	
	/**
	 * Render a username link.
	 * 
	 * @param mixed  $identifier
	 * @param array  $htmlOptions
	 */
	public static function username($identifier = null, $htmlOptions = array()) {
		if ($identifier == null) {
			$identifier = Yii::app()->user->getState('user');
		}
		$user = $identifier instanceof User ? $identifier : User::load($identifier);
		return CHtml::link($user->username, array('user/', 'id' => $user->uid), $htmlOptions);
	}
	
	/**
	 * Render a user avatar with link to user profile page.
	 * 
	 * @param string $userOrUid
	 * @param string $size
	 * @param array  $htmlOptions
	 * @param array  $imgOptions
	 * @return string
	 */
	public static function userAvatarLink($userOrUid = null, $size = 'big', $htmlOptions = array(), $imgOptions  = array()) {
		if ($userOrUid === null) {
			$userOrUid = Yii::app()->user->getState('user');
		}
		$user = $userOrUid instanceof User ? $userOrUid : User::load($userOrUid);
		
		$img = self::userAvatar($user, $size, $imgOptions);
		return CHtml::link($img, array('user/', 'id' => $user->uid));
	}
	
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
	
	public static function formattedTimestamp($timestamp) {
		return date('m月d日 H:i', $timestamp);
	}
	
}
