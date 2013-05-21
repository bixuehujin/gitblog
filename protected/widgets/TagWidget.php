<?php
/**
 * TagWidget class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

class TagWidget extends CWidget {
	/**
	 * tags the widget should render.
	 * @var array array of Tag object.
	 */
	public $tags;
	
	public $prefix;
	
	public $htmlOptions = array('class'=>'tags');
	
	public $label = '';
	
	public $itemOptions = array();
	
	public function run() {
		echo $this->buildHtml();
	}
	
	protected function buildHtml() {
		$html = '<div ' . CHtml::renderAttributes($this->htmlOptions) . '>';
		if(!empty($this->label)) {
			$html .= "<span>{$this->label}</span>";
		}
		foreach ($this->tags as $tag) {
			$tagName = $this->prefix ? $this->prefix . $tag->name : $tag->name;
			$html .= CHtml::link($tagName, array('/view/tag', 'id'=>$tag->tid, 'htmlOptions'=>$this->itemOptions)) . ' ';
		}
		$html .= '</div>';
		return $html;
	}
}
