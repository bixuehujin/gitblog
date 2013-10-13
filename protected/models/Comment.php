<?php
/**
 * Comment AR class file.
 * 
 * @author JinHu <bixuehujin@gmail.com>
 */

/**
 * Model used for present user comments.
 * 
 * @property integer $cid
 * @property integer $creator
 * @property integer $owner
 * @property string  $owner_type
 * @property string  $subject
 * @property string  $content
 * @property integer $created
 * @property array   $state
 * @property integer $deleted
 * 
 * @property string $formattedDate Human readable date format.
 */
class Comment extends CActiveRecord {
	
	private $_parent;
	private $_owner;
	
	/**
	 * @return Comment
	 */
	public static function model($className = __CLASS__) {
		return parent::model($className);
	}
	
	public function tableName() {
		return 'comment';
	}
	
	public function rules() {
		return array(
			array('owner,owner_type,content', 'required'),
		);
	}
	
	protected function beforeSave() {
		if ($this->getIsNewRecord()) {
			$this->created = time();
		}
		$this->state = serialize($this->state);
		return parent::beforeSave();
	}
	
	protected function afterFind() {
		if ($this->state != null) {
			$this->state = unserialize($this->state);
		}
		return parent::afterFind();
	}
	
	public function setState($name, $value) {
		$state = $this->state;
		$state[$name] = $value;
		$this->state = $state;
		return $this;
	}
	
	public function getState($name, $default = null) {
		$state = $this->state;
		return isset($state[$name]) ? $state[$name] : $default;
	}
	
	public function getParentObject() {
		if ($this->_parent === null) {
			$this->_parent = Comment::model()->findByPk($this->parent);
		}
		return $this->_parent;
	}
	
	public function getOwnerObject() {
		if ($this->_owner === null) {
			$this->_owner = Post::load($this->owner);
		}
		return $this->_owner;
	}
	
	public function avatar($size = 'big', $htmlOptions = array()) {
		if ($this->creator) {
			$ret = GitBlog::userAvatar($this->creator, $size, $htmlOptions);
		}else {
			$ret = CHtml::image('/images/avatar-default.jpg', '', $htmlOptions);
		}
		return $ret;
	}
	
	
	public function avatarLink($size = 'big', $htmlOptions = array(), $imgOptions = array()) {
		return CHtml::link($this->avatar($size, $imgOptions), $this->getWebsite(), $htmlOptions);
	}
	
	/**
	 * @return User
	 */
	public function getAuthor() {
		$author = '匿名用户';
		if ($this->creator && $user = User::load($this->creator)) {
			$author = $user->username;
		}else {
			$author = $this->getState('author', $author);
		}
		return $author;
	}
	
	/**
	 * @return string
	 */
	public function getWebsite() {
		$website = '';
		if ($this->creator) {
			$website = Yii::app()->controller->createUrl('/user/', array('id' => $this->creator));
		}else {
			$website = $this->getState('website', $website);
		}
		return $website;
	}
	
	public function getAuthorLink($htmlOptions = array()) {
		return CHtml::link($this->getAuthor(), $this->getWebsite(), $htmlOptions);
	}
	
	public function getFormattedDate() {
		return date('m月d日 H:i', $this->created);
	}
	
	public function getFormattedCreated() {
		return date('m月d日 H:i', $this->created);
	}
	
	public static function load($cid) {
		return self::model()->findByPk($cid);
	}
	
	/**
	 * Fetch Comment DataProvider by its owner.
	 * 
	 * @param Commentable $owner
	 * @param integer $pageSize
	 * @return CActiveDataProvider
	 */
	public static function fetchProviderByOwner(Commentable $owner, $pageSize = 10) {
		$criteria = new CDbCriteria();
		$criteria->addColumnCondition(array(
			'owner' => $owner->getOwnerId(),
			'owner_type' => $owner->getOwnerType(),
		));
		//$criteria->order = 'cid DESC';
		return new CActiveDataProvider(__CLASS__, array(
			'criteria' => $criteria,
			'totalItemCount' => $owner->getCommentCount(),
			'pagination' => array(
				'pageVar' => 'p',
				'pageSize' => $pageSize
			)
		));
	}
	
	/**
	 * @param integer $pageSize
	 * @return CActiveDataProvider
	 */
	public static function fetchProviderOfSent($pageSize = 10) {
		$criteria = new CDbCriteria();
		$criteria->addColumnCondition(array(
			'creator' => Yii::app()->user->getId(),
			'owner_type' => 'post',
		));
		$criteria->order = 'cid DESC';
		return new CActiveDataProvider(__CLASS__, array(
			'criteria' => $criteria,
			'pagination' => array(
				'pageVar' => 'p',
				'pageSize' => $pageSize,
			),
		));
	}
	
	/**
	 * @param integer $pageSize
	 * @return CActiveDataProvider
	 */
	public static function fetchProviderOfReceived($pageSize = 10) {
		//select c.cid, c.parent, p.cid, c.owner from comment c 
		//join post on c.owner=post.pid join comment p  on c.parent=p.cid  
		//where post.author=1 or p.creator=1
		$uid = Yii::app()->user->getId();
		$criteria = new CDbCriteria();
		$criteria->condition = "post.author=:uid or p.creator=:uid";
		$criteria->select = 'c.*';
		$criteria->join = 'join post on c.owner=post.pid left join comment p  on c.parent=p.cid';
		$criteria->alias = 'c';
		$criteria->order = 'c.cid DESC';
		$criteria->params = array(':uid' => $uid);
		
		return new CActiveDataProvider(__CLASS__, array(
			'criteria' => $criteria,
			'pagination' => array(
				'pageVar' => 'p',
				'pageSize' => $pageSize,
			),
		));
	}
}
