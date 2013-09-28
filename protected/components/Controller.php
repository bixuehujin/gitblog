<?php
/**
 * Controller class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 * @since 2012-10-10
 */

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController{
	
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout = '//layouts/column2';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu = array();
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
	 * @var PageLayout
	 */
	private $_pageLayout;
	
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
		//$this->menu = $this->primaryMenuItems();
		$this->getPageLayout();
	}
	
	/**
	 * Primary menu items.
	 * 
	 * @return array
	 */
	protected function primaryMenuItems() {
		$route = $this->getRequestRoute();
		$model = Category::model();
		$list = $model->getList();
		$items [] = array('label' => Yii::t('view', 'Home'), 'url' => Yii::app()->getBaseUrl() . '/', 'active' => $route == '') ;
		foreach ($list as $item) {
			$items[] = array(
				'label' => $item->name,
				'url' => array('/view/category', 'id' => $item->category_id),
			);
		}
		return $items;
	}
	
	public function setBreadcrumbs($links) {
		Yii::app()->getComponent('layout')->setBreadcrumbs($links);
		return $this;
	}
	
	public function getBreadcrumbs() {
		Yii::app()->getComponent('layout')->getBreadcrumbs();
	}
	
	/**
	 * @return PageLayout
	 */
	public function getPageLayout() {
		if ($this->_pageLayout === null) {
			$this->_pageLayout = Yii::app()->getComponent('layout');
		}
		return $this->_pageLayout;
	}
	
	/**
	 * User menu items such as login, logout.
	 * 
	 * @return array
	 */
	protected function userMenuItems() {
		$isGuest = Yii::app()->user->getIsGuest();
		$items[] = array('label' => Yii::app()->user->getName(), 'url' => array('/user/'), 'visible' => !$isGuest);
		$items[] = array('label' => Yii::t('view', 'Sign Up'), 'url' => array('/site/register'), 'visible' => $isGuest && Yii::app()->settings->get('site_register_on', 1));
		$items[] = array('label' => Yii::t('view', 'Sign In'), 'url' => array('/site/login'), 'visible' => $isGuest);
		$items[] = array('label' => Yii::t('view', 'My Account<b class="caret"></b>'), 'url' => array('#'), 'visible' => !$isGuest, 'items' => array(
			array('label' => '系统管理', 'url' => array('/admin'), 'visible' => !Yii::app()->user->isGuest, 'linkOptions' => array('target' => '_blank')),
			array('label' => '基本信息', 'url' => array('/account/info')),
			array('label' => '头像设置', 'url' => array('/account/avatar')),
			array('label' => '密码设置', 'url' => array('/account/password')),
			array('label' => '', 'itemOptions' => array('class' => 'divider')),
			array('label' => Yii::t('view', 'Logout'), 'url' => array('/site/logout')),
		),  'submenuOptions' => array('class' => 'dropdown-menu', 'role' => 'menu'),
			'itemOptions' => array('class' => 'dropdown'),
			'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown')
		);
		
		return $items;
	}
	
	/**
	 * Set the page title.
	 *
	 * @param string $title
	 * @param string $domain
	 */
	public function setTitle($title, $domain = null) {
		$this->pageTitle = $title;
		if ($domain != null) {
			$this->pageTitle .= ' - ' . $domain;
		}
		$this->pageTitle .= ' | ' . Yii::app()->settings->get('site_name');
	}
}
