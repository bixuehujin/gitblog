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
	
	private $commentOwner;
	
	/**
	 * Constructor.
	 * 
	 * @param string $scenario
	 * @param Commentable $owner  The owner of the comment.
	 * @throws CException
	 */
	public function __construct($scenario = null, $owner = null) {
		if ($scenario == null) {
			$this->scenario = Yii::app()->user->getIsGuest() ? self::SCENARIO_ANONYMOUS : self::SCENARIO_REGISTER;
		}
		if (!$owner instanceof Commentable) {
			throw new CException("The argument 'owner' must be instance of Commentable");
		}
		$this->commentOwner = $owner;
		$this->owner = $owner->getOwnerId();
		$this->owner_type = $owner->getOwnerType();
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
			'content' => Yii::t('view', 'Comment Content'),
			'email' => Yii::t('view', 'Email'),
			'website' => Yii::t('view', 'Website'),
			'author' => Yii::t('view', 'Author')
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
			Yii::app()->console->addSuccess(Yii::t('view', 'Add comment success'));
			return true;
		} else {
			Yii::app()->console->addError(Yii::t('view', 'Add comment failed'));
			return false;
		}
	}
}
