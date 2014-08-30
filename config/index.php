<?php

//
// Path Definition
//
define('ROOT', __DIR__ . '/..');
define('APP_ROOT', ROOT . '/app');
define('CONFIG_ROOT', ROOT . '/config');
define('DB_ROOT', ROOT . '/db');
define('LIB_ROOT', ROOT . '/lib');
define('TEMPLATES_ROOT', ROOT . '/templates');
define('TMP_ROOT', ROOT . '/tmp');
define('VENDOR_ROOT', ROOT . '/vendor');
define('SESSIONS_ROOT', TMP_ROOT . '/sessions');
set_include_path(get_include_path() . PATH_SEPARATOR . ROOT);


//
// Environments, Vendors, Consts and Global Variables
//
require_once 'config/environments.php';
require_once VENDOR_ROOT . '/autoload.php';
define('SITE_NAME', 'Pinfee');
define('ENCODING', 'UTF-8');
define('SESSION_FLASHES_NAMESPACE', '__flashes__');
$FLASH_KEYS = array(
    'pages.index.notification' => 'pages.index.notification',
    'pages.products.show.notification' => 'pages.products.show.notification',
);


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
require_once LIB_ROOT . '/core.php';
require_once LIB_ROOT . '/validation/index.php';


//
// Configuration by Server API
//
$sapi_name = php_sapi_name();
if ($sapi_name === 'cli') {
    require_once CONFIG_ROOT . '/cli.php';
} else {
    // "cli-server", "apache2handler" etc
    require_once CONFIG_ROOT . '/http.php';
}
