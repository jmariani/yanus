<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Yanus Console Application',
    // application components
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'ext.giix-components.*', // giix components
    ),
    'preload' => array('log'),
    'components' => array(
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
//                'levels' => 'trace, info',
                    'categories' => 'tamaprocessincominginvoicefile',
                    'logFile' => 'tamaprocessincominginvoicefile.log'
                ),
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
                // uncomment the following to show log messages on web pages
                array(
                    'class' => 'CWebLogRoute',
                ),
            ),
        ),
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=yanus;port=8889',
            'emulatePrepare' => true,
            'username' => 'bdmexdem_root',
            'password' => 'toor',
            'charset' => 'utf8',
            'tablePrefix' => '',
        ),

//        'db' => array(
//            'connectionString' => 'sqlite:' . dirname(__FILE__) . '/../data/testdrive.db',
//        ),
    // uncomment the following to use a MySQL database
    /*
      'db'=>array(
      'connectionString' => 'mysql:host=localhost;dbname=testdrive',
      'emulatePrepare' => true,
      'username' => 'root',
      'password' => '',
      'charset' => 'utf8',
      ),
     */
    ),
);