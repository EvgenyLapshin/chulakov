<?php
/**
 * index.php file
 *
 * @author Laco <info@laco.pro>
 * @link http://laco.pro
 * @copyright 2013 Laco
 */
require('./../app/vendor/autoload.php');

Yiinitializr\Helpers\Initializer::create('./../app', 'main', array('common', 'env', 'local'))->run();