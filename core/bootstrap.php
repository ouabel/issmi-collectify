<?php

$config = __DIR__ . '/config.inc.php';

if (!file_exists($config)){
	copy(__DIR__ . '/config.inc.sample.php', $config);
}

require_once $config;
require_once __DIR__ . '/../vendor/autoload.php';
use RedBeanPHP\Facade as R;

if(empty(R::$currentDB)){
	#MySQL
	#$dsn = sprintf('%s:host=%s;dbname=%s', DB_TYPE, DB_HOST, DB_NAME);
	#R::setup($dsn, DB_USER, DB_PASSWORD);
	
	# Sqlite
	$dsn = sprintf('%s:%s/%s.db', DB_TYPE, DB_DIR, DB_NAME);
	R::setup($dsn);
}