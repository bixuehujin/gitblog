<?php
class TagWidget extends CWidget {
	/**
	 * tags the widget should render.
	 * @var array array of Tag object.
	 */
	public $tags;
	
	public function run() {
		$this->render('/tag', array('tags'=>$this->tags));
	}
}