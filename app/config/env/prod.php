<?php
/**
 * prod.php configuration file
 *
 * @author Laco <info@laco.pro>
 * @link http://laco.pro
 * @copyright 2013 Laco
 */
return array(
	'components' => array(
		'db' => array(
			'connectionString' => 'mysql:host=localhost;dbname={DB_NAME}',
			'username' => '{DB_USER}',
			'password' => '{DB_PASSWORD}',
			'enableProfiling' => false,
			'enableParamLogging' => false,
			'charset' => 'utf8',
		),
	),
	'params' => array(
		'yii.debug' => false,
		'yii.traceLevel' => 0,
		'yii.handleErrors'   => APP_CONFIG_NAME !== 'test',
	)
);