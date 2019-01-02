<?php

/*
 *Database
 */
define('DB_TYPE', 'sqlite');
define('DB_DIR', __dir__ . '/../db');
#define('DB_TYPE', 'mysql');
#define('DB_HOST', 'localhost');
define('DB_NAME', 'collectify');
#define('DB_USER', 'root');
#define('DB_PASSWORD', 'root');

/*
 * RedBean configuration
 */
define('REDBEAN_MODEL_PREFIX', '\\Collectify\\Model\\');

/**
 * Collectify configuration
 */
define('DEFAULT_CONTROLLER', 'home');
define('DEFAULT_ACTION', 'homepage');
