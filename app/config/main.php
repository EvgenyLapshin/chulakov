<?php
/**
 * main.php configuration file
 *
 * @author Laco <info@laco.pro>
 * @link http://laco.pro
 * @copyright 2013 Laco
 */
require_once(dirname(__FILE__) . '/../vendor/laco/helpers/YiiShortcutFunctions.php');

defined('APP_CONFIG_NAME') or define('APP_CONFIG_NAME', 'main');
use Yiinitializr\Helpers\ArrayX;

// web application configuration
return ArrayX::merge(array(
        'name' => 'Галерея Химии',
        'language' => 'ru',
        'defaultController' => 'page',
        'homeUrl' => '/',

        'aliases' => array(
            'app' => dirname(__FILE__) . '/..',
            'ext' => dirname(__FILE__) . '/../extensions',
            'webRoot' => dirname(__FILE__) . '/../../www',
            'JsonSchema' => dirname(__FILE__) . '/../vendor/JsonSchema',
        ),

        'behaviors' => array(),

        'controllerMap' => array(),

        'modules' => array(
            'user' => array(
                'class' => 'application.modules.user.UserModule',
                'defaultController' => 'manager'
            ),
            'auth' => array(
                'class' => 'application.modules.auth.AuthModule',
                'userNameColumn' => 'username',
                'appLayout' => 'application.modules.admin.views.layouts.main',
            ),
            'admin' => array(
                'class' => 'application.modules.admin.AdminModule',
            ),
            'api' => array(
                'class' => 'application.modules.api.ApiModule',
            )
        ),

        'components' => array(
            'settings' => array(
                'class' => 'laco.components.Settings',
            ),
            'response' => array(
                'class' => 'laco.components.Response',
            ),
            'requestToComtec' => array(
                'class' => 'application.modules.api.components.RequestToComtec',
            ),
            'clientScript' => array(/*'scriptMap' => array(
				'bootstrap.min.css' => false,
				'bootstrap.min.js' => false,
				'bootstrap-yii.css' => false
			)*/
            ),
            'urlManager' => array(
                'class' => 'laco.components.web.SUrlManager',
                'urlFormat' => 'path',
                'showScriptName' => false,
                //'urlSuffix' => '.html',

                'multiLanguageEnabled' => false, // при включении настроить rules ниже

                // для мультиязычности, добавить в начало каждого правила <language:(ru|en)>/
                'rules' => array(
                    '<module:(admin|user|auth|gii|api)>' => '<module>',
                    '<module:(admin|user|auth|gii|api)>/<path:\S+>' => '<module>/<path>',

                    '<controller:(article|news|catalog|search)>' => '<controller>',
                    '<controller:(article|catalog)>/<alias:[-\w]+>' => '<controller>/all',
                    '<controller:(article|news)>/view/<alias:[-\w]+>' => '<controller>/view',
                    '<controller:(catalog)>/product/<alias:[-\w]+>' => '<controller>/product',

                    'lk/<controller:\w+>/<action:\w+>' => 'lk/<controller>/<action>',
                    'lk/<controller:\w+>' => 'lk/<controller>',

                    '<controller:gallery>/<alias:\w+>' => '<controller>/index',

                    '<controller:(template)>' => '<controller>/index',
                    '<controller:(site|template)>/<action:[-\w]+>' => '<controller>/<action>',

                    '<controller:[-\w]+>/<id:\d+>' => '<controller>/view',
                    '<controller:[-\w]+>/<action:[-\w]+>/<id:\d+>' => '<controller>/<action>',
                    '<alias:[-\w]+>' => 'page/index',
                    '<controller:[-\w]+>/<action:[-\w]+>' => '<controller>/<action>',

                )
            ),
            'user' => array(
                'class' => 'application.modules.auth.components.AuthWebUser',
                'allowAutoLogin' => true,
                'loginUrl' => array('user/login')
            ),
            'authManager' => array(
                'class' => 'CDbAuthManager',
                'behaviors' => array(
                    'auth' => array(
                        'class' => 'application.modules.auth.components.AuthBehavior',
                        'admins' => array('root'), // users with full access
                    ),
                ),
            ),
            'errorHandler' => array(
                'errorAction' => 'site/error',
            ),
            'mailer' => array(
                'class' => 'app.vendor.mailer.EMailer',
                'pathViews' => 'app.vendor.views.email',
                'pathLayouts' => 'app.vendor.views.email.layouts',
                'CharSet' => 'utf-8',
                'FromName' => 'chemgallery.ru',
               // 'Mailer' => 'sendmail',
                'From' => 'do.not.reply@chemgallery.ru',
            ),
            'log' => array(
                'class' => 'CLogRouter',
                'routes' => array(
                    array(
                        'class' => 'CFileLogRoute',
                        'levels' => 'error',
                    ),
                    array(
                        'class' => 'CDbLogRoute',
                        'connectionID' => 'db',
                        'logTableName' => 'log',
                        'levels' => 'error',
                        'filter' => array(
                            'class' => 'CLogFilter',
                            'logUser' => true,
                        )
                    ),
                    array(
                        'class' => 'CEmailLogRoute',
                        'levels' => 'error',
                        'categories' => 'js',
                        'emails' => ['support@laco.pro'],
                        'subject' => '[error][js] Купавнареактив',
                        'filter' => array(
                            'class' => 'CLogFilter',
                            'logUser' => true,
                        ),
                        'sentFrom' => 'logger@chemgallery.ru',
                        'headers' => array('Content-Type: text/plain; charset=UTF-8')
                    ),
                    array(
                        'class' => 'CEmailLogRoute',
                        'levels' => 'error',
                        'categories' => 'api',
                        'emails' => ['support@laco.pro'],
                        'subject' => '[error][api] Купавнареактив',
                        'filter' => array(
                            'class' => 'CLogFilter',
                            'logUser' => true,
                        ),
                        'sentFrom' => 'logger@prj2.laco.ru',
                        'headers' => array('Content-Type: text/plain; charset=UTF-8')
                    ),
                    array(
                        'class' => 'CEmailLogRoute',
                        'levels' => 'info',
                        'categories' => 'formValidateErrors',
                        'emails' => ['support@laco.pro'],
                        'subject' => '[error][formValidateErrors] chemgallery.ru',
                        'filter' => array(
                            'class' => 'CLogFilter',
                            'logUser' => true,
                        ),
                        'sentFrom' => 'logger@chemgallery.ru',
                        'headers' => array('Content-Type: text/plain; charset=UTF-8')
                    )
                )
            ),
            'button' => array(
                'class' => 'vendor.laco.materialize.components.MDetectedButton'
            ),
            'cart' => array(
                'class' => 'app.extensions.components.cart.Cart'
            ),
            'cookies' => array(
                'class' => 'vendor.laco.components.web.MCookies'
            )
        ),
        'params' => array('search' => array())
    ),
    require_once('common.php'));