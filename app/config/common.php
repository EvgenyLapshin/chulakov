<?php
/**
 * common.php configuration file
 *
 * @author Laco <info@laco.pro>
 * @link http://laco.pro
 * @copyright 2013 Laco
 */
return array(
    'basePath' => realPath(__DIR__ . '/..'),
    'preload' => array('log'),
    'aliases' => array(
        'vendor' => 'app.vendor',
        'laco' => 'vendor.laco',
        'materialize' => 'laco.materialize'
    ),
    'import' => array(
        'app.controllers.*',
        'app.extensions.components.*',
        'app.extensions.behaviors.*',
        'app.helpers.*',
        'app.models.*',
        'app.models.cart.*',
        'app.models.forms.*',
        'app.models.forms.lk.*',
        'app.widgets.*',
        'app.modules.user.models.*',
        'app.modules.api.components.*',
        'app.modules.auth.models.*',

        'laco.behaviors.*',
        'laco.components.*',
        'laco.components.ar.*',
        'laco.components.web.*',
        'laco.components.web.dataProvider.*',
        'laco.helpers.*',
        'materialize.behaviors.*',
        'materialize.helpers.*',
        'materialize.components.*',
        'laco.uploader.*',
        'laco.uploader.widgets.*',
        'laco.uploader.widgets.redactor.*'
    ),
    'params' => array(
        'php.defaultCharset' => 'utf-8',
        'php.timezone' => 'Europe/Moscow',
        'resetSuffix' => '0.0.3'
    )
);