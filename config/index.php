<?php
require_once '../config/environments.php';


define('ROOT', '..');
define('APP_ROOT', ROOT . '/app');
define('DB_ROOT', ROOT . '/db');
define('LIB_ROOT', ROOT . '/lib');
define('TEMPLATES_ROOT', ROOT . '/templates');


define('ENCODING', 'UTF-8');


$_DB = new SQLite3(DB_ROOT . '/' . DATABASE_FILE_NAME);


require_once LIB_ROOT . '/functions.php';
