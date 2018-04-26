<?php
/**
 * console.php configuration file
 *
 * @author Laco <info@laco.pro>
 * @link http://laco.pro
 * @copyright 2013 Laco
 */
defined('APP_CONFIG_NAME') or define('APP_CONFIG_NAME', 'console');
return array(
	'commandMap' => array(
		'migrate' => array(
			'class' => 'system.cli.commands.MigrateCommand',
			'migrationPath' => 'application.cli.migrations'
		)
	)
);