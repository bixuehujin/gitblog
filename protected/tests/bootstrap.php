<?php
$loader = require __DIR__ . '/../vendors/autoload.php';
$loader->add('ecom', __DIR__ . '/../vendors/');

$config = __DIR__ . '/../config/test.php';

// disable Yii error handling logic
defined('YII_ENABLE_EXCEPTION_HANDLER') or define('YII_ENABLE_EXCEPTION_HANDLER',false);
defined('YII_ENABLE_ERROR_HANDLER') or define('YII_ENABLE_ERROR_HANDLER',false);

require __DIR__ . '/../vendors/yiisoft/yii/framework/YiiBase.php';
require __DIR__ . '/../Yii.php';

Yii::import('system.test.CTestCase');
Yii::import('system.test.CDbTestCase');
Yii::import('system.test.CWebTestCase');


require __DIR__ . '/WebTestCase.php';

Yii::createWebApplication($config);
