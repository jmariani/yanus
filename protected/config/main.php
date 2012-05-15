<?php

/**
 * Main configuration.
 * All properties can be overridden in mode_<mode>.php files
 */
return array(
    // Set yiiPath (relative to Environment.php)
    //$yii=dirname(__FILE__).'/../../framework/yii.php';
    'yiiPath' => dirname(__FILE__) . '/../../../../framework/yii.php',
    'yiicPath' => dirname(__FILE__) . '/../../../../framework/yiic.php',
    'yiitPath' => dirname(__FILE__) . '/../../../../framework/yiit.php',
    // Set YII_DEBUG and YII_TRACE_LEVEL flags
    'yiiDebug' => true,
    'yiiTraceLevel' => 0,
    // Static function Yii::setPathOfAlias()
    'yiiSetPathOfAlias' => array(
    // uncomment the following to define a path alias
    //'local' => 'path/to/local-folder'
//        'cfd' => dirname(__FILE__) . '/files/cfd'
    ),
    // This is the main Web application configuration. Any writable
    // CWebApplication properties can be configured here.
    'configWeb' => array(
        'theme' => 'yanus',
        'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
        'name' => 'Yanus',
        // Preloading 'log' component
        'preload' => array(
            'bootstrap', // preload the bootstrap component
            'chilkat',
            'log',
            'nusoap',
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
            'chilkat' => array(
                'class' => 'ext.EChilkatLibrary'
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
            'nusoap' => array(
                'class' => 'ext.ENuSoapLibrary'
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
            // adding the simple Workflow source component
            'swSource' => array(
                'class' => 'application.extensions.simpleWorkflow.SWPhpWorkflowSource',
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
            'widgetFactory' => array(
                'widgets' => array(
                    'CGridView' => array(
                        'htmlOptions' => array('cellspacing' => '0', 'cellpadding' => '0'),
                        'itemsCssClass' => 'item-class',
                        'pagerCssClass' => 'pager-class'
                    ),
                    'CJuiTabs' => array(
                        'htmlOptions' => array('class' => 'shadowtabs'),
                    ),
                    'CJuiAccordion' => array(
                        'htmlOptions' => array('class' => 'shadowaccordion'),
                    ),
                    'CJuiProgressBar' => array(
                        'htmlOptions' => array('class' => 'shadowprogressbar'),
                    ),
                    'CJuiSlider' => array(
                        'htmlOptions' => array('class' => 'shadowslider'),
                    ),
                    'CJuiSliderInput' => array(
                        'htmlOptions' => array('class' => 'shadowslider'),
                    ),
                    'CJuiButton' => array(
                        'htmlOptions' => array('class' => 'shadowbutton'),
                    ),
                    'CJuiButton' => array(
                        'htmlOptions' => array('class' => 'shadowbutton'),
                    ),
                    'CJuiButton' => array(
                        'htmlOptions' => array('class' => 'button green'),
                    ),
                ),
            ),
        ),
        // autoloading model and component classes
        'import' => array(
            'application.models.*',
            'ext.bootstrap.widgets.*',
            'application.components.*',
            'application.vendors.*',
            'ext.giix-components.*', // giix components
            'application.modules.user.*',
            'application.modules.user.models.*',
            'application.modules.user.components.*',
            'application.modules.rights.*',
            'application.modules.rights.components.*',
            'application.extensions.yii-mail.*',
            'application.extensions.simpleWorkflow.*', // Import simpleWorkflow extension
        ),
        'modules' => array(
            'ataintegrant',
            'erp' => array(
//            'install' => true,
            ),
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
            'institutional',
            'user' => array(
                'tableUsers' => 'users',
                'tableProfiles' => 'profiles',
                'tableProfileFields' => 'profiles_fields',
                'registrationUrl' => '/yanus/RegisterForm'
            ),
            'rights' => array(
//            'install' => true,
            ),
        ),
        // application-level parameters that can be accessed
        // using Yii::app()->params['paramName']
        'params' => array(
            'demorfc' => 'AAA010101AAA',
            'ORIGINAL_STRING_XSLT_3.0' => 'ftp://ftp2.sat.gob.mx/asistencia_servicio_ftp/publicaciones/solcedi/cadenaoriginal_3_0.xslt',
            'ORIGINAL_STRING_XSLT_3.2' => 'http://www.sat.gob.mx/sitio_internet/cfd/3/cadenaoriginal_3_0/cadenaoriginal_3_2.xslt',
            'ORIGINAL_STRING_TFD_XSLT_1.0' => 'ftp://ftp2.sat.gob.mx/asistencia_ftp/publicaciones/solcedi/cadenaoriginal_TFD_1_0.xslt',
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
        'preload' => 'inherit',
        // Autoloading model and component classes
        'import' => 'inherit',
        // Application componentshome
        'components' => 'inherit',
        'params' => 'inherit'
    ),
);