<?php

/**
 * base controller for admin management.
 *  
 * @author hujin
 */
class AdminController extends CController {
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='column2';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	*/
	public $breadcrumbs=array();
	
	/**
	 * All driven class should implement the method, to specify what menu items should be
	 * rendered on the left side.
	 * 
	 * @return array
	 * array pass to {@link CMenu zii.widgets.CMenu}, default to empty array.
	 */
	public function menuItems() {
		return array();
	}
	
}