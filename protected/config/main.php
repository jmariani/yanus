<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Yanus',
    // preloading 'log' component
    'preload' => array(
        'log',
        'bootstrap', // preload the bootstrap component
    ),
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
//        'db' => array(
//            'connectionString' => 'sqlite:' . dirname(__FILE__) . '/../data/testdrive.db',
//        ),
        // uncomment the following to use a MySQL database
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=yanus;port=3306',
            'emulatePrepare' => true,
            'username' => 'bdmexdem_root',
            'password' => 'toor',
            'charset' => 'utf8',
            'tablePrefix' => '',
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
        'mail' => array(
            'class' => 'application.extensions.yii-mail.YiiMail',
            'transportType' => 'smtp',
            'transportOptions' => array(
                'host' => 'xxx.xxx.xxx.xxx',
                'username' => 'username',
                'password' => 'password',
            ),
            'viewPath' => 'application.views.mail',
            'logging' => true,
            'dryRun' => false
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
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'noreply@bdinformatica.com.mx',
    ),
);