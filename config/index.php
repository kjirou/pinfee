<?php

//
// Path Definition
//
define('ROOT', dirname(__FILE__) . '/..');
define('APP_ROOT', ROOT . '/app');
define('DB_ROOT', ROOT . '/db');
define('LIB_ROOT', ROOT . '/lib');
define('TEMPLATES_ROOT', ROOT . '/templates');
define('TMP_ROOT', ROOT . '/tmp');
define('SESSIONS_ROOT', TMP_ROOT . '/sessions');
set_include_path(get_include_path() . PATH_SEPARATOR . ROOT);


//
// Environments, Consts and Global Variables
//
require_once 'config/environments.php';
define('ENCODING', 'UTF-8');
define('SESSION_FLASHES_NAMESPACE', '__flashes__');


//
// Session Configuration
//
if (!file_exists(SESSIONS_ROOT)) {
    mkdir(SESSIONS_ROOT);
    chmod(SESSIONS_ROOT, 0777);
}
session_save_path(SESSIONS_ROOT);
session_start();

// Flashes Initialization
if (!array_key_exists(SESSION_FLASHES_NAMESPACE, $_SESSION)) {
    $_SESSION[SESSION_FLASHES_NAMESPACE] = array();
}


//
// Database Configuration
//
$_DB = new SQLite3(DB_ROOT . '/' . DATABASE_FILE_NAME);


//
// Requirements
//
require_once LIB_ROOT . '/functions.php';
