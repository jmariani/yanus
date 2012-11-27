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
        'log' => dirname(__FILE__) . DIRECTORY_SEPARATOR . 'protected' . DIRECTORY_SEPARATOR . 'runtime' . DIRECTORY_SEPARATOR . 'log'
    ),
    // This is the main Web application configuration. Any writable
    // CWebApplication properties can be configured here.
    'configWeb' => array(
        'aliases' => array(
            //assuming you extracted the files to the extensions folder
            'xupload' => 'ext.xupload'
        ),
        'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
        'name' => 'Yanus',
        // Preloading 'log' component
        'preload' => array(
            'bootstrap', // preload the bootstrap component
            'chilkat',
            'log',
            'nusoap',
            'tcpdf',
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
            'file' => array(
                'class' => 'application.extensions.file.CFile',
            ),
            'log' => array(
                'class' => 'CLogRouter',
                'routes' => array(
                    array(
                        'class' => 'CFileLogRoute',
                        'levels' => 'error, warning, info',
                    ),
                    array(
                        'class' => 'CFileLogRoute',
//                'levels' => 'trace, info',
                        'categories' => 'ext.yii-mail.YiiMail',
                        'logFile' => 'yii-mail.log'
                    ),
                    array(
                        'class' => 'CFileLogRoute',
                        'categories' => 'castrolprocessincominginvoicefile',
                        'logFile' => 'castrolprocessincominginvoicefile.log'
                    ),
                    // uncomment the following to show log messages on web pages
                    array(
                        'class' => 'CWebLogRoute',
                    ),
                ),
            ),
            'nusoap' => array(
                'class' => 'ext.ENuSoapLibrary'
            ),
            'phoneFormatter' => array(
                'class' => 'ext.components.EPhoneFormatter', // assuming you extracted bootstrap under extensions
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
            'tcpdf' => array(
                'class' => 'ext.ETcPdfLibrary'
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
//            'widgetFactory' => array(
//                'widgets' => array(
//                    'CGridView' => array(
//                        'htmlOptions' => array('cellspacing' => '0', 'cellpadding' => '0'),
//                        'itemsCssClass' => 'item-class',
//                        'pagerCssClass' => 'pager-class'
//                    ),
//                    'CJuiTabs' => array(
//                        'htmlOptions' => array('class' => 'shadowtabs'),
//                    ),
//                    'CJuiAccordion' => array(
//                        'htmlOptions' => array('class' => 'shadowaccordion'),
//                    ),
//                    'CJuiProgressBar' => array(
//                        'htmlOptions' => array('class' => 'shadowprogressbar'),
//                    ),
//                    'CJuiSlider' => array(
//                        'htmlOptions' => array('class' => 'shadowslider'),
//                    ),
//                    'CJuiSliderInput' => array(
//                        'htmlOptions' => array('class' => 'shadowslider'),
//                    ),
//                    'CJuiButton' => array(
//                        'htmlOptions' => array('class' => 'shadowbutton'),
//                    ),
//                    'CJuiButton' => array(
//                        'htmlOptions' => array('class' => 'shadowbutton'),
//                    ),
//                    'CJuiButton' => array(
//                        'htmlOptions' => array('class' => 'button green'),
//                    ),
//                ),
//            ),
        ),
        // autoloading model and component classes
        'import' => array(
            'application.actions.*',
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
            'application.modules.lookup.models.*',
//            'ext.bootstraplinkpager.*',
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
            'lookup' => array(
                'class' => 'application.modules.lookup.LookupModule',
            ),
            'user' => array(
                'tableUsers' => 'users',
                'tableProfiles' => 'profiles',
                'tableProfileFields' => 'profiles_fields',
//                'registrationUrl' => array('/user/bootRegistration'),
//                'recoveryUrl' => array("/user/recovery/recovery"),
//                'loginUrl' => array("/user/login"),
//                'logoutUrl' => array("/user/logout"),
//                'profileUrl' => array("/user/profile"),
//                'returnUrl' => array("/site/index"),
//                'returnLogoutUrl' => array("/user/login"),
                'returnLogoutUrl' => array("/site/index"),
                'loginForm' => "/user/bootLogin",
                'recoveryForm' => "/recovery/bootRecovery",
                'registerForm' => "/user/bootRegistration",
            ),
            'rights' => array(
//            'install' => true,
            ),
        ),
        // application-level parameters that can be accessed
        // using Yii::app()->params['paramName']
        'params' => array(
            '72HS_IN_SECONDS' => 259200,
            'allowRegistration' => false,
            'defaultPageSize' => 10,
            'demorfc' => 'AAA010101AAA',
            'incomingInvoiceInterfaceFileUploadPath' => '/tmp/upload/incomingInvoiceInterfaceFiles',
            'nativeXmlPath' => '/tmp/upload/nativeXml',
            'pageSizeOptions' => array(10 => 10, 20 => 20, 50 => 50, 100 => 100),
            'SAT_CER_BASE_PATH' => 'ftp://ftp2.sat.gob.mx/Certificados/FEA',
            'URI_CFD2.0' => 'http://www.sat.gob.mx/cfd/2',
            'URI_CFD2.2' => 'http://www.sat.gob.mx/cfd/2',
            'URI_CFD3.0' => 'http://www.sat.gob.mx/cfd/3',
            'URI_CFD3.2' => 'http://www.sat.gob.mx/cfd/3',
            'XSD_CFD2.0' => 'http://www.sat.gob.mx/sitio_internet/cfd/2/cfdv2.xsd',
            'XSD_CFD2.2' => 'http://www.sat.gob.mx/sitio_internet/cfd/2/cfdv22.xsd',
            'XSD_CFD3.0' => 'http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv3.xsd',
            'XSD_CFD3.2' => 'http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv32.xsd',
            'XSD_TFD1.0' => 'http://www.sat.gob.mx/TimbreFiscalDigital/TimbreFiscalDigital.xsd',
            'XSLT_OS_CFD2.0' => 'http://www.sat.gob.mx/sitio_internet/cfd/2/cadenaoriginal_2_0/cadenaoriginal_2_0.xslt',
            'XSLT_OS_CFD2.2' => 'http://www.sat.gob.mx/sitio_internet/cfd/2/cadenaoriginal_2_0/cadenaoriginal_2_2.xslt',
            'XSLT_OS_CFD3.0' => 'ftp://ftp2.sat.gob.mx/asistencia_servicio_ftp/publicaciones/solcedi/cadenaoriginal_3_0.xslt',
            'XSLT_OS_CFD3.2' => 'http://www.sat.gob.mx/sitio_internet/cfd/3/cadenaoriginal_3_0/cadenaoriginal_3_2.xslt',
            'XSLT_OS_TFD1.0' => 'ftp://ftp2.sat.gob.mx/asistencia_ftp/publicaciones/solcedi/cadenaoriginal_TFD_1_0.xslt',
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
        'components' => array(
            'file' => array(
                'class' => 'application.extensions.file.CFile',
            ),
            'log' => array(
                'class' => 'CLogRouter',
                'routes' => array(
                    array(
                        'class' => 'CFileLogRoute',
                        'levels' => 'error, warning, trace',
                    ),
                    array(
                        'class' => 'CFileLogRoute',
//                'levels' => 'trace, info',
                        'categories' => 'ext.yii-mail.YiiMail',
                        'logFile' => 'yii-mail.log'
                    ),
                    array(
                        'class' => 'CFileLogRoute',
                        'categories' => 'IncomingInvoiceInterfaceFileProcessor',
                        'logFile' => 'processincominginvoicefile.log'
                    ),
                    array(
                        'class' => 'CFileLogRoute',
                        'categories' => 'ProcessIncomingInvoiceFile',
                        'logFile' => 'processincominginvoicefile.log'
                    ),
                    array(
                        'class' => 'CFileLogRoute',
                        'categories' => 'ProcessIncomingInvoiceNativeXmlFile',
                        'logFile' => 'processincominginvoicevativexmlfile.log'
                    ),
                // uncomment the following to show log messages on web pages
//                    array(
//                        'class' => 'CWebLogRoute',
//                    ),
                ),
            ),
            'nusoap' => array(
                'class' => 'ext.ENuSoapLibrary'
            ),
            'phoneFormatter' => array(
                'class' => 'EPhoneFormatter', // assuming you extracted bootstrap under extensions
            ),
            // adding the simple Workflow source component
            'swSource' => array(
                'class' => 'application.extensions.simpleWorkflow.SWPhpWorkflowSource',
            ),
            'tcpdf' => array(
                'class' => 'ext.ETcPdfLibrary'
            ),
        ),
        'params' => 'inherit'
    ),
);