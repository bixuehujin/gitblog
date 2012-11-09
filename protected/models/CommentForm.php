<?php
class CommentForm extends CFormModel {
	
	public $content;
	public $post_id;
	public $email;
	public $website;
	public $author;
	public $comment_ref;
	
	public function init() {
		
	}
	
	public function rules() {
		return array(
				array('content', 'length', 'min' => 1),
				array('post_id', 'required'),
				array('author', 'required'),
				array('email', 'required'),
				array('website', 'required'),
				array('comment_ref', 'type', 'type'=>'integer')
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
		$comment = new Comment();
		$comment->attributes = $this->attributes;
		if ($this->validate() && $comment->save(false)) {
			return true;
		} else {
			return false;
		}
	}
	
}