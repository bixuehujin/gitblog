<?php
/**
 * PostNavigation class file.
 * @author Jin Hu <bixuehujin@gmail.com>
 */

Yii::import('zii.widgets.CMenu');

/**
 * Post Navigation implementaion base on zii.widgets.CMenu.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */
class PostNavigation extends CWidget {
	
	/**
	 * @var array the navigation array will be rendered.
	 * the structure should looks like the following:
	 * <pre>
	 *     array(
	 *         array('label'=>'title', 'url'=>url of item, 'items'=>array(
	 *             array('label'=>'title', 'url'=> url of sub item)
	 *         )),
	 *         array('label'=>'title', 'url'=>url of item)
	 *     )
	 * </pre>
	 */
	public $navItems = array();
	/**
	 * @var array specify html attributes for navigation container element.
	 */
	public $htmlOptions = array('class'=>'navigation');
	/**
	 * @var array specify html attributes for top ul element.
	 */
	public $topmenuOptions = array('class'=>'nav nav-list');
	/**
	 * @var array specify html attributes for sub ul element.
	 */
	public $submenuOptions = array('class'=>'nav nav-list');
	
	
	public function run() {
		if(!is_array($this->navItems)) {
			return;
		}
		Yii::app()->clientScript->pregisterScriptFile(__DIR__ . '/views/post_navigation.js')
			->pregisterCssFile(__DIR__ . '/views/post_navigation.css');
		$items = $this->navItems;

		$this->processNavItems($items);
		
		$output = $this->widget('zii.widgets.CMenu', array(
			'items'=>$items,
			'htmlOptions'=>$this->topmenuOptions,
		), true);
		$this->renderFile($this->getViewFile('post_navigation'), array(
			'items' => $items,
		));
	}
	
	/**
	 * render html options array to a string.
	 * @param array $htmlOptions
	 * @return string
	 */
	protected function renderHtmlOptions(array $htmlOptions) {
		$ret = '';
		foreach($htmlOptions as $key=>$value) {
			if(is_array($value)) {
				$value = implode(' ', $value);
			}
			$ret .= strtr(' {name}="{value}"', array('{name}'=>$key, '{value}'=>$value));
		}
		return $ret;
	}
	
	/**
	 * preproccess navigation items, add some extra attributes.
	 * @param array $items
	 */
	protected function processNavItems(&$items) {
		foreach($items as &$item) {
			if(isset($item['items'])) {
				$item['submenuOptions'] = $this->submenuOptions;
				$this->processNavItems($item['items']);
			}
		}
	}
}
