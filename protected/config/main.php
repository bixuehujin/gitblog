<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'侠古仁风的博客',
	'defaultController' => 'view',
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'system.web.helpers.*',
	),

	'modules'=>array(
		'admin' => array(),
		// uncomment the following to enable the Gii tool
		/*
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'Enter Your Password Here',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		*/
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		'systemSettings'=>array(
			'class' => 'SystemSettings',
			'dbName' => 'system'
		),
		'sessionMessager' => array(
			'class' => 'SessionMessager',
		),
		'clientScript' => array(
			'class' => 'ClientScript',
			'coreScriptUrl' => 'assets',
			'packages' => array(
				'bootstrap' => array(
						'css' => array('bootstrap/css/bootstrap.css'),
				),
				'bootstrap.responsive' => array(
						'css' => array('bootstrap/css/bootstrap-responsive.css'),
						'depends' => array('bootstrap')
				),
				'bootstrap.plugins' => array(
						'js' => array('bootstrap/js/bootstrap.js'),
						'depends' => array('bootstrap', 'jquery'),
				),
				'jquery.html5_upload' => array(
						'js' => array('jquery/jquery.html5_upload.js'),
						'depends' => array('jquery'),
				),
				'jquery.form' => array(
						'js' => array('jquery/jquery.form.js'),
						'depends' => array('jquery'),
				),
				'jquery.scrollTo' => array(
						'js' => array('jquery.scrollTo.js'),
						'depends' => array('jquery'),
				),
				'template' => array(
						'js' => array('template.js'),
				),
			),
		),
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=gitblog',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'sdyxzsdyxz',
			'charset' => 'utf8',
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
						'class'=>'CFileLogRoute',
						'levels'=>'error, warning,info,trace,profile',
				),
				array(
						'class'=>'CFileLogRoute',
						'levels' => 'error, warning,info,trace,profile',
						'categories'=>'system.db.*',
						'logFile'=>'sql.log',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);
