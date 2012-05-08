<?php

/**
 * Development configuration
 * Usage:
 * - Local website
 * - Local DB
 * - Show all details on each error
 * - Gii module enabled
 */
return array(
    // Set yiiPath (relative to Environment.php)
    //'yiiPath' => dirname(__FILE__) . '/../../../yii/framework/yii.php',
    //'yiicPath' => dirname(__FILE__) . '/../../../yii/framework/yiic.php',
    //'yiitPath' => dirname(__FILE__) . '/../../../yii/framework/yiit.php',
    // Set YII_DEBUG and YII_TRACE_LEVEL flags
    'yiiDebug' => true,
    'yiiTraceLevel' => 3,
    // Static function Yii::setPathOfAlias()
    'yiiSetPathOfAlias' => array(
    // uncomment the following to define a path alias
    //'local' => 'path/to/local-folder'
    ),
    // This is the specific Web application configuration for this mode.
    // Supplied config elements will be merged into the main config array.
    'configWeb' => array(
        // Application components
        'components' => array(
            // Database
            // uncomment the following to use a MySQL database
            'db' => array(
                'connectionString' => 'mysql:host=localhost;dbname=yanus;port=3306',
                'emulatePrepare' => true,
                'username' => 'bdmexdem_root',
                'password' => 'toor',
                'charset' => 'utf8',
                'tablePrefix' => '',
            ),
            // Mail
            'mail' => array(
                'class' => 'application.extensions.yii-mail.YiiMail',
                'transportType' => 'smtp',
                'transportOptions' => array(
                    'host' => 'smtp.gmail.com',
                    'username' => 'jorgemariani@gmail.com',
                    // or email@googleappsdomain.com
                    'password' => 'pipe1967',
                    'port' => '465',
                    'encryption' => 'ssl',
//                'host' => 'localhost',
//                'username' => 'username',
//                'password' => 'password',
                ),
                'viewPath' => 'application.views.mail',
                'logging' => true,
                'dryRun' => false
            ),
        ),
        'modules' => array(
            // uncomment the following to enable the Gii tool
            'gii' => array(
                'class' => 'system.gii.GiiModule',
                'password' => 'pipeline',
                // If removed, Gii defaults to localhost only. Edit carefully to taste.
                'ipFilters' => array('127.0.0.1', '::1'),
                'generatorPaths' => array(
                    'ext.giix-core', // giix generators
                    'ext.wsdl2php', // wsdl2pgp generators
                    'bootstrap.gii', // since 0.9.1
                    'application.gii'
                ),
            ),
            'user' => array(
                'tableUsers' => 'users',
                'tableProfiles' => 'profiles',
                'tableProfileFields' => 'profiles_fields',
            ),
            'rights' => array(
//            'install' => true,
            ),
        ),
        // application-level parameters that can be accessed
        // using Yii::app()->params['paramName']
        'params' => array(
            // this is used in contact page
            // this is used in contact page
            'adminEmail' => 'jorgemariani@gmail.com',
            'noreplyEmail' => 'jorgemariani@gmail.com',
        ),
    ),
    // This is the Console application configuration. Any writable
    // CConsoleApplication properties can be configured here.
    // Leave array empty if not used.
    // Use value 'inherit' to copy from generated configWeb.
    'configConsole' => array(
    ),
);