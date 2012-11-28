<?php
// change the following paths if necessary
//$yiic=dirname(__FILE__).'/../../../framework/yiic.php';
//$config=dirname(__FILE__).'/config/console.php';
//require_once($yiic);

// set environment

require_once(dirname(__FILE__) . '/extensions/yii-environment/Environment.php');
$env = new Environment();
//$env = new Environment('PRODUCTION'); //override mode
// set debug and trace level
defined('YII_DEBUG') or define('YII_DEBUG', $env->yiiDebug);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', $env->yiiTraceLevel);

// run Yii app
//$env->showDebug(); // show produced environment configuration
$config=$env->configConsole;
require_once($env->yiicPath);

//$env->runYiiStatics(); // like Yii::setPathOfAlias()
//Yii::createWebApplication($env->configWeb)->run();
?>