<?php
// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name' => 'Git Blog Console Application',

	// preloading 'log' component
	'preload' => array('log'),
	'timezone' => 'Asia/Shanghai',
	'aliases' => array(
		'ecom' => 'application.vendors.ecom.ecom',
	),
	'import' => array(
		'application.models.*',
		'application.components.*',
		'ecom.models.*',
		'ecom.components.*',
		'system.web.helpers.*',
	),
	// application components
	'components' => array(
		'db' => array(
			'connectionString' => 'mysql:host=127.0.0.1;dbname=gitblog',
			'emulatePrepare' => true,
			'username' => 'test',
			'password' => 'test',
			'charset' => 'utf8',
		),
		'settings' => array(
			'class' => 'ecom\settings\Settings',
		),
		'log' => array(
			'class' => 'CLogRouter',
			'routes' => array(
				array(
					'class' => 'CFileLogRoute',
					'levels' => 'error, warning',
				),
			),
		),
	),
);
