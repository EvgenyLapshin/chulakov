<?php
/**
 * dev.php configuration file
 *
 * @author Laco <info@laco.pro>
 * @link http://laco.pro
 * @copyright 2013 Laco
 */
return array(
    'modules' => array(
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'yii',
            'generatorPaths' => array(
                'bootstrap.gii',
                'ext.mGii'
            ),
            'ipFilters'=>array('127.0.0.1','::1','192.168.56.1')
        ),
    ),
    'components' => array(
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=yii', //netbook - fs
            'username' => 'root',
            'password' => '',
            'schemaCachingDuration' => 0 , //  1000 days
            'enableParamLogging' => true,
            'enableProfiling' => true,
            'charset' => 'utf8'
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                /*                array( // configuration for the toolbar
                                    'class' => 'app.vendor.yii-debug-toolbar.YiiDebugToolbarRoute',
                                    'ipFilters' => array('127.0.0.1'),
                                ),*/
                array(
                    'class' => 'CWebLogRoute',
                    'levels' => 'error, warning',
                ),
            ),
        ),

    ),
    'params' => array(
        'yii.handleErrors' => true,
        'yii.debug' => true,
        'yii.traceLevel' => 3,
    )
);