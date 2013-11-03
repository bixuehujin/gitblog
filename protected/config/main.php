<?php
return array(
	'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
	'name' => 'GitBlog Content Management System',
	'defaultController' => 'view',
	'preload' => array('log', 'bootstrap'),
	'language' => 'zh_cn',
	'timeZone' => 'Asia/Shanghai',
	'aliases' => array(
		'ecom' => 'application.vendors.ecom.ecom',
		'bootstrap' => 'application.vendors.crisu83.yii-bootstrap',
	),
	'import' => array(
		'application.models.*',
		'application.components.*',
		'application.components.widgets.*',
		'application.components.exceptions.*',
		'ecom.models.*',
		'ecom.components.*',
		'system.web.helpers.*',
	),
	'behaviors' => array(
		'siteConfig' => 'application.behaviors.SiteConfigBehavior',
	),
	'modules' => array(
		'admin' => array(),
		/*
		'gii' => array(
			'class' => 'system.gii.GiiModule',
			'password' => 'Enter Your Password Here',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters' => array('127.0.0.1', '::1'),
			'generatorPaths' => array(
				'bootstrap.gii',
			),
		),
		*/
	),
	/*
	 'behaviors' => array(
	 	'sitePermissions' => array(
	 		'class' => 'application.behaviors.SitePermissionsBehavior',
	 		'autoRebuild' => true,
	 	),
	 ),
*/
	// application components
	'components' => array(
		'request' => array(
			'enableCsrfValidation' => true,
		),
		'user' => array(
			// enable cookie-based authentication
			'allowAutoLogin' => true,
		),
		'assetManager' => array(
			'basePath' => __DIR__ . '/../../assets',
			'forceCopy' => YII_DEBUG,
		),
		'settings' => array(
			'class' => 'ecom\settings\Settings',
		),
		'userData' => array(
			'class'=>'ecom.components.AttachedDataComponent',
			'name'=>'user',
		),
		'bootstrap' => array(
			'class' => 'bootstrap.components.Bootstrap',
		),
		'clientScript' => array(
			'class' => 'ecom.components.MinifyClientScript',
			'coreScriptUrl' => '/assets',
			'debug' => YII_DEBUG,
			'packages' => array(
				'jquery.scrollTo' => array(
					'js' => array('jquery.scrollTo.js'),
					'depends' => array('jquery'),
				),
				'template' => array(
					'js' => array('template.js'),
				),
			),
		),
		'urlManager' => array(
			'urlFormat' => 'path',
			'rules' => array(
				'user/<id:\d+>/' => 'user/',
				'user/<id:\d+>/<action:\w+>' => 'user/<action>',
				'<controller:\w+>/<id:\d+>' => '<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
				'post/<path:[\w\/\._-]+>' => 'post/view',
				'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
			),
			'showScriptName' => false,
			'appendParams' => false,
		),
		'db' => array(
			'connectionString' => 'mysql:host=localhost;dbname=gitblog',
			'emulatePrepare' => true,
			'username' => 'test',
			'password' => 'test',
			'charset' => 'utf8',
		),
		'authManager' => array(
			'class' => 'DbAuthManager',
		),
		'errorHandler' => array(
			// use 'site/error' action to display errors
			'errorAction' => 'site/error',
		),
		'log' => array(
			'class' => 'CLogRouter',
			'routes' => array(
				array(
					'class' => 'CFileLogRoute',
					'levels' => 'error, warning,info,trace,profile',
				),
				array(
					'class' => 'CFileLogRoute',
					'levels' => 'error, warning,info,trace,profile',
					'categories' => 'system.db.*',
					'logFile' => 'sql.log',
				),
				array(
					'class' => 'CFileLogRoute',
					'levels' => 'error, warning,info,trace,profile',
					'categories' => 'application.*',
					'logFile' => 'gitblog.log',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class' => 'CWebLogRoute',
				),
				*/
			),
		),
		'mailgun' => array(
			'class' => 'ecom.components.EMailgun',
			'config' => array(
				'password' => 'key-8urgft93rdddn1zr03kjq1hfp64a3xt9',
				'domain'=> 'hujin.mailgun.org',
			),
			'defaultSender' => 'i@hujin.me',
		),
		'layout' => array(
			'class' => 'ecom.components.PageLayout',
			'defaultHeader' => array('/common/header', array()),
			'defaultFooter' => array('/common/footer', array()),
			'layout' => '//layouts/column3',
		),
		'console' => array(
			'class' => 'ecom.components.Console'
		),
		'fileManager' => array(
			'class' => 'ecom.components.FileManager',
			'thumbBasePath' => 'thumbnails',
			'domains' => array(
				'avatar' => 'avatar',
			),

		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params' => array(
		// this is used in contact page
		'adminEmail' => 'webmaster@example.com',
	),
);
