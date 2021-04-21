<?php
//
// FILE : mvc-app/Config/config.php
//

// if machine = localhost, then we are in development
if ($_SERVER['SERVER_NAME'] === 'localhost') {
  include 'config.local.php';
  define('DEV_MODE', true);
} else {
  include 'config.prod.php';
  define('DEV_MODE', false);
}

/** Separator between folders */
define('DS', DIRECTORY_SEPARATOR);

/** Absolute path to the project folder */
define('ROOT_PATH', realpath(__DIR__ . DS . '..' . DS . '..') . DS);

/** Absolute paths */
define('APP_PATH', ROOT_PATH . 'mvc-app' . DS);
define('STORAGE_PATH', APP_PATH . 'Storage' . DS);
define('ASSETS_PATH', ROOT_PATH . 'public' . DS . 'mvc' . DS . 'assets' . DS);
define('ROOT_URL', str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']));

/* Full URL of the application in http: // or https: // */
define('ROOT', (stripos($_SERVER['SERVER_PROTOCOL'], 'https') === false ? 'http' : 'https') . '://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] .  ROOT_URL);
