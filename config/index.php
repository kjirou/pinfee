<?php
define('ROOT', dirname(__FILE__) . '/..');
define('APP_ROOT', ROOT . '/app');
define('DB_ROOT', ROOT . '/db');
define('LIB_ROOT', ROOT . '/lib');
define('TEMPLATES_ROOT', ROOT . '/templates');
set_include_path(get_include_path() . PATH_SEPARATOR . ROOT);


require_once 'config/environments.php';


define('ENCODING', 'UTF-8');


$_DB = new SQLite3(DB_ROOT . '/' . DATABASE_FILE_NAME);


require_once LIB_ROOT . '/functions.php';
