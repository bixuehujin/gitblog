<?php

/**
 * base controller for admin management.
 *  
 * @author Jin Hu <bixuehujin@gmail.com>
 */

class AdminController extends CController {
	/**
	 * @var string the default layout for the controller view. Defaults to 
	 * '//layouts/column1', meaning using a single column layout. See 
	 * 'protected/views/layouts/column1.php'.
	 */
	public $layout='column2';
	/**
	 * @var array context menu items. This property will be assigned to 
	 * {@link CMenu::items}.
	 */
	public $menu;
	/**
	 * @var array the breadcrumbs of the current page. The value of this property
	 * will be assigned to {@link CBreadcrumbs::links}. Please refer to 
	 * {@link CBreadcrumbs::links} for more details on how to specify this 
	 * property.
	 */
	public $breadcrumbs=array();
	
	/**
	 * man section title.
	 * @var string
	 */
	public $sectionTitle;
	
	
	public function init() {
		$this->menu = array(
			array(
				'label'=>'Home', 
				'url'=>array('/admin'), 
				'active' => $_GET['r'] == 'admin'
			),
			array(
				'label'=>'User', 
				'url'=>array('/admin/user'), 
				'active' => preg_match('/admin\/user.*/', $_GET['r'])
			),
			array(
				'label'=>'Source', 
				'url'=>array('/admin/source'), 
				'active' => preg_match('/admin\/source.*/', $_GET['r'])
			),
			array(
				'label'=>'Content', 
				'url'=>array('/admin/content'), 
				'active' => preg_match('/admin\/content.*/', $_GET['r'])
			),
			array(
				'label'=>'System', 
				'url'=>array('/admin/system'), 
				'active' => preg_match('/admin\/system.*/', $_GET['r'])
			),
			array(
				'label' => 'Member',
				'url' => array('/admin/member'),
				'visiable' => Yii::app()->user->id == 1,
				'active' => preg_match('/admin\/member.*/', $_GET['r']),
			),
			array(
				'label'=>'Back To Front', 
				'url'=>array('/')
			)
		);
	}
	
	/**
	 * All driven classes should implement the method, to specify what menu
	 * items should be rendered on the left side.
	 *
	 * @return array
	 * array pass to {@link CMenu zii.widgets.CMenu}, default to empty array.
	 */
	public function menuItems() {
		return array();
	}
	
}
