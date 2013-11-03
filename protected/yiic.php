<?php
$loader = require __DIR__ . '/vendors/autoload.php';
$loader->add('ecom', __DIR__ . '/vendors/');

// fix for fcgi
defined('STDIN') or define('STDIN', fopen('php://stdin', 'r'));

defined('YII_DEBUG') or define('YII_DEBUG',true);

require __DIR__ . '/vendors/yiisoft/yii/framework/YiiBase.php';
require __DIR__ . '/Yii.php';

$config = __DIR__ . '/config/console.php';

$app=Yii::createConsoleApplication($config);
$app->commandRunner->addCommands(YII_PATH.'/cli/commands');

$env=@getenv('YII_CONSOLE_COMMANDS');
if(!empty($env))
	$app->commandRunner->addCommands($env);

$app->run();
