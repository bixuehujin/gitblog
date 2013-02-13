<?php
/**
 * Controller class file.
 * @author Jin Hu <bixuehujin@gmail.com>
 */

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column2';
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
	 * @var array widgets list should rendered. the structure should looks like:
	 * <pre>
	 *     array(
	 *         'widgetName'=>array of arguments,
	 * 	       'widgetName2'=>array of arguments
	 *     )
	 * </pre>
	 */
	public $widgets = array();
	/**
	 * Items for render user links such as login, logout etc...
	 * @var array
	 */
	public $userMenu = array();
	
	/**
	 * Get the route of the current route.
	 * 
	 * @return string
	 */
	public function getRequestRoute() {
		static $route;
		if (!isset($route)) {
			$route = Yii::app()->getUrlManager()->parseUrl(Yii::app()->getRequest());
		}
		return $route;
	}
	
	public function init() {
		if ($this->getRequestRoute() == 'view') {
			$this->redirect('/');
		}
		$this->menu = $this->primaryMenuItems();
		$this->userMenu = $this->userMenuItems();
	}
	
	
	/**
	 * primary menu items.
	 * @return array
	 */
	protected function primaryMenuItems() {
		$route = $this->getRequestRoute();
		$model = Category::model();
		$list = $model->getList();
		$items [] = array('label'=>'主页', 'url'=>Yii::app()->getBaseUrl() . '/', 'active'=> $route == '') ;
		foreach ($list as $item) {
			$items[] = array(
					'label' => $item->name,
					'url' => array('/view/category', 'id'=>$item->category_id),
			);
		}
		return $items;
	}
	
	/**
	 * user menu items such as login, logout.
	 * @return array
	 */
	protected function userMenuItems() {
		$items[] = array('label'=>'联系', 'url'=>array('/site/contact'), 'visible'=>Yii::app()->user->isGuest);
		$items[] = array('label'=>'登录', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest);
		$items[] = array('label'=>'管理', 'url'=>array('/admin'), 'visible'=>!Yii::app()->user->isGuest);
		$items[] = array('label'=>'退出', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest);
		
		return $items;
	}
}