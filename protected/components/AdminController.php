<?php
/**
 * AdminController class file.
 *  
 * @author Jin Hu <bixuehujin@gmail.com>
 */

/**
 * Base controller for admin management pages.
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
		$route = Yii::app()->getUrlManager()->parseUrl(Yii::app()->getRequest());
		$this->menu = array(
			array(
				'label'=>'Home', 
				'url'=>array('/admin'), 
				'active' => $route == 'admin'
			),
			array(
				'label'=>'User', 
				'url'=>array('/admin/user'), 
				'active' => preg_match('/admin\/user.*/', $route)
			),
			//array(
			//	'label'=>'Source', 
			//	'url'=>array('/admin/source'), 
			//	'active' => preg_match('/admin\/source.*/', $route)
			//),
			array(
				'label'=>Yii::t('admin', 'Content'), 
				'url'=>array('/admin/content'), 
				'active' => preg_match('/admin\/content.*/', $route)
			),
			array(
				'label'=>Yii::t('admin', 'System'), 
				'url'=>array('/admin/system'), 
				'active' => preg_match('/admin\/system.*/', $route)
			),
			array(
				'label'=>Yii::t('admin', 'Localization'),
				'url'=>array('/admin/localization'),
				'active' => preg_match('/admin\/localization.*/', $route)
			),
			array(
				'label' => Yii::t('admin', 'Member'),
				'url' => array('/admin/member'),
				'visiable' => Yii::app()->user->id == 1,
				'active' => preg_match('/admin\/member.*/', $route),
			),
			array(
				'label'=>Yii::t('admin', 'Back To Front'), 
				'url'=>Yii::app()->getBaseUrl() . '/'
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
