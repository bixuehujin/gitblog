<?php
/**
 * CommentForm class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

class CommentForm extends CFormModel {
	
	const SCENARIO_ANONYMOUS = 'anonymous';
	const SCENARIO_REGISTER  = 'register';
	
	public $content;
	public $owner;
	public $owner_type;
	public $email;
	public $website;
	public $author;
	public $parent;
	
	private $post;
	
	
	public function __construct($scenario = null, $post = null) {
		if ($scenario == null) {
			$this->scenario = Yii::app()->user->getIsGuest() ? self::SCENARIO_ANONYMOUS : self::SCENARIO_REGISTER;
		}
		if (!$post instanceof Commentable || !$post->getOwnerId()) {
			throw new CException("The argument 'post' is not valid.");
		}
		$this->post = $post;
		$this->owner = $post->getOwnerId();
		$this->owner_type = $post->getOwnerType();
	}
	
	public function isAnonymousScenario() {
		return $this->getScenario() == self::SCENARIO_ANONYMOUS;
	}
	
	public function isRegisterScenario() {
		return $this->getScenario() == self::SCENARIO_REGISTER;
	}
	
	public function rules() {
		return array(
			array('content,owner,owner_type', 'required'),
			array('author,email,website', 'required', 'on' => self::SCENARIO_ANONYMOUS),
			array('parent', 'type', 'type'=>'integer')
		);
	}
	
	
	public function attributeLabels() {
		return array(
			'content' => '评论内容',
			'email' => '电子邮件',
			'website' => '网站',
			'author' => '作者',		
		);
	}
	
	
	public function save() {
		if (!$this->validate()) {
			Yii::app()->console->addModel($this);
			return false;
		}
		$comment = new Comment();
		$comment->setAttributes($this->getAttributes(), false);
		$comment->creator = Yii::app()->user->getId();
		if ($this->isAnonymousScenario()) {
			$comment->setState('author', $this->author)
				->setState('email', $this->email)
				->setState('website', $this->website);
		}
		if ($comment->save(false)) {
			Yii::app()->console->addSuccess('评论成功');
			return true;
		} else {
			Yii::app()->console->addError('评论失败');
			return false;
		}
	}
}
