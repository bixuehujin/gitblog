<?php
/**
 * SiteConfigBehavior class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

class SiteConfigBehavior extends CBehavior {
	
	public function events() {
		return array(
			'onBeginRequest' => 'beginRequest',
		);
	}
	
	public function beginRequest($event) {
		$app = $this->getOwner();
	    $settings = $app->getComponent('settings');
	    $app->language = $settings['site_default_language'];
	}
}
