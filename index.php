<?php

//// change the following paths if necessary
//$yii=dirname(__FILE__).'/../../framework/yii.php';
//$config=dirname(__FILE__).'/protected/config/main.php';
//
//// remove the following lines when in production mode
//defined('YII_DEBUG') or define('YII_DEBUG',true);
//// specify how many levels of call stack should be shown in each log message
//defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
//
//require_once($yii);
//Yii::createWebApplication($config)->run();

// set environment
require_once(dirname(__FILE__) . '/protected/extensions/yii-environment/Environment.php');
$env = new Environment();
//$env = new Environment('PRODUCTION'); //override mode

// set debug and trace level
defined('YII_DEBUG') or define('YII_DEBUG', $env->yiiDebug);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', $env->yiiTraceLevel);

// run Yii app
//$env->showDebug(); // show produced environment configuration
require_once($env->yiiPath);
$env->runYiiStatics(); // like Yii::setPathOfAlias()
$app = Yii::createWebApplication($env->configWeb);

// set 'files' alias
// /Applications/MAMP/public_html/yanus/protected/files
Yii::setPathOfAlias('files', Yii::getPathOfAlias('application') . DIRECTORY_SEPARATOR . 'files');
if (!file_exists(Yii::getPathOfAlias('files'))) mkdir(yii::getPathOfAlias('files'), 0777, true);

// set 'upload' alias
// /Applications/MAMP/public_html/yanus/protected/files/upload
Yii::setPathOfAlias('upload', Yii::getPathOfAlias('files') . DIRECTORY_SEPARATOR . 'upload');
if (!file_exists(Yii::getPathOfAlias('upload'))) mkdir(yii::getPathOfAlias('upload'), 0777, true);

// set 'incomingInvoiceInterfaceFiles' alias
// /Applications/MAMP/public_html/yanus/protected/files/upload/incomingInvoiceInterfaceFiles
Yii::setPathOfAlias('incomingInvoiceInterfaceFiles', Yii::getPathOfAlias('upload') . DIRECTORY_SEPARATOR . 'incomingInvoiceInterfaceFiles');
if (!file_exists(Yii::getPathOfAlias('incomingInvoiceInterfaceFiles'))) mkdir(yii::getPathOfAlias('incomingInvoiceInterfaceFiles'), 0777, true);

$app->run();
