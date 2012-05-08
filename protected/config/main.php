<?php

/**
 * Main configuration.
 * All properties can be overridden in mode_<mode>.php files
 */
return array(
    // Set yiiPath (relative to Environment.php)
    //$yii=dirname(__FILE__).'/../../framework/yii.php';
    'yiiPath' => dirname(__FILE__).'/../../framework/yii.php',
    'yiicPath' => dirname(__FILE__).'/../../framework/yiic.php',
    'yiitPath' => dirname(__FILE__).'/../../framework/yiit.php',
    // Set YII_DEBUG and YII_TRACE_LEVEL flags
    'yiiDebug' => true,
    'yiiTraceLevel' => 0,
    // Static function Yii::setPathOfAlias()
    'yiiSetPathOfAlias' => array(
    // uncomment the following to define a path alias
    //'local' => 'path/to/local-folder'
    ),
    // This is the main Web application configuration. Any writable
    // CWebApplication properties can be configured here.
    'configWeb' => array(
        'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
        'name' => 'Yanus',
        // Preloading 'log' component
        'preload' => array(
            'log',
            'bootstrap', // preload the bootstrap component
        ),
        // Autoloading model and component classes
        // autoloading model and component classes
        'import' => array(
            'application.models.*',
            'application.components.*',
            'ext.giix-components.*', // giix components
            'application.modules.user.models.*',
            'application.modules.user.components.*',
            'application.modules.rights.*',
            'application.modules.rights.components.*',
            'application.extensions.yii-mail.*',
        ),
        // application components
        'components' => array(
            'authManager' => array(
                'class' => 'RDbAuthManager',
                'connectionID' => 'db',
                'defaultRoles' => array('Authenticated', 'Guest'),
            ),
            'bootstrap' => array(
                'class' => 'ext.bootstrap.components.Bootstrap', // assuming you extracted bootstrap under extensions
            ),
            'cache' => array(
                'class' => 'system.caching.CFileCache',
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
                        'levels' => 'error, warning',
                    ),
                    array(
                        'class' => 'CFileLogRoute',
//                'levels' => 'trace, info',
                        'categories' => 'ext.yii-mail.YiiMail',
                        'logFile' => 'yii-mail.log'
                    ),
                // uncomment the following to show log messages on web pages
//                array(
//                    'class' => 'CWebLogRoute',
//                ),
                ),
            ),
            'settings' => array(
                'class' => 'CmsSettings',
                'cacheComponentId' => 'cache',
                'cacheId' => 'global_website_settings',
                'cacheTime' => 84000,
                'tableName' => '{{settings}}',
                'dbComponentId' => 'db',
                'createTable' => true,
                'dbEngine' => 'InnoDB',
            ),
            // uncomment the following to enable URLs in path-format
            'urlManager' => array(
                'urlFormat' => 'path',
                'showScriptName' => false,
                'rules' => array(
                    '<controller:\w+>/<id:\d+>' => '<controller>/view',
                    '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                    '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                ),
            ),
//        'user' => array(
//            // enable cookie-based authentication
//            'allowAutoLogin' => true,
//        ),
            'user' => array(
                'class' => 'RWebUser',
                // enable cookie-based authentication
                'allowAutoLogin' => true,
                'loginUrl' => array('/user/login'),
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
//            'adminEmail' => 'webmaster@example.com',
        ),
    ),
    // This is the Console application configuration. Any writable
    // CConsoleApplication properties can be configured here.
    // Leave array empty if not used.
    // Use value 'inherit' to copy from generated configWeb.
    'configConsole' => array(
        'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
        'name' => 'My Console Application',
        // Preloading 'log' component
        'preload' => array('log'),
        // Autoloading model and component classes
        'import' => 'inherit',
        // Application componentshome
        'components' => array(
            // Database
            'db' => 'inherit',
            // Application Log
            'log' => array(
                'class' => 'CLogRouter',
                'routes' => array(
                    // Save log messages on file
                    array(
                        'class' => 'CFileLogRoute',
                        'levels' => 'error, warning, trace, info',
                    ),
                ),
            ),
        ),
    ),
);