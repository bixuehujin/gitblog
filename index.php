<?php
$loader = require __DIR__ . '/protected/vendors/autoload.php';
$loader->add('ecom', __DIR__ . '/protected/vendors/');

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require __DIR__ . '/protected/vendors/yiisoft/yii/framework/YiiBase.php';
require __DIR__ . '/protected/Yii.php';

$config = __DIR__ . '/protected/config/main.php';

Yii::createWebApplication($config)->run();
