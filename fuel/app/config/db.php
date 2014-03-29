<?php
return array(

	/*
	 * If you don't specify a DB configuration name when you create a connection
	 * the configuration to be used will be determined by the 'active' value
	 */
	'active' => 'default',

	/**
	 * Base PDO config
	'default' => array(
		'type'        => 'pdo',
		'connection'  => array(
			'persistent' => false,
			'compress'   => false,
		),
		'identifier'   => '`',
		'table_prefix' => '',
		'charset'      => 'utf8',
		'collation'    => false,
		'enable_cache' => true,
		'profiling'    => false,
		'readonly'     => false,
	),
	 */

	/**
	 * Base MySQLi config
	 */

	'default' => array(
		'type'        => 'mysqli',
		'connection'  => array(
			'hostname'   => 'localhost',
			'username'   => 'root',
			'password'   => false,
			'database'   => 'fuel_dev',
			'persistent' => false,
		),
		'identifier'   => '`',
		'table_prefix' => '',
		'charset'      => 'utf8',
		'collation'    => false,
		'enable_cache' => true,
		'profiling'    => false,
		'readonly'     => false,
	),
	

	/**
	 * Base Redis config
	 */
	'redis' => array(
		'default' => array(
			'hostname'  => '127.0.0.1',
			'port'      => 6379,
			'timeout'	=> null,
			'database'  => 0
		)
	),

);
