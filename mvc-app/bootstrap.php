<?php
session_start();
//
// FILE :  / app / bootstrap.php
//

// Integrate COMPOSER
require 'vendor/autoload.php';
// Load the configuration constants files
require 'Config/config.php';
// Usage functions
require 'Libs/functions.php';


/////////////////////////////////
/// Integration of components ///
/////////////////////////////////

// Error display
$whoops = new \Whoops\Run;
if (DEV_MODE) {
  $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
} else {
  // Saving errors to file app\Storage\error.log
  $whoops->pushHandler(function ($exception, $inspector, $run) {
    $errorFile = STORAGE_PATH . 'error.log';
    $output = date("Y-m-d H:i:s") . ' L' . $exception->getLine() . ' ' .
      $exception->getFile() . ':: ' . $exception->getMessage() . "\n" .
      file_get_contents($errorFile);
    file_put_contents($errorFile, $output);
  });
}
$whoops->register();


// TWIG views
use Twig\Extra\String\StringExtension;
// Specify the TWIG templates folder
$loader = new Twig_Loader_Filesystem(APP_PATH . 'Views');
// TWIG configuration parameterss
$twig = new Twig_Environment($loader, array(
  // TWIG cache folder
  'cache' => STORAGE_PATH . 'cache' . DS . 'twig',
  // If false, variables that do not exist do not raise an error
  'strict_variables ' => false,
  // Possibility of debugging
  'debug' => true
));
// Additional components for debugging
$twig->addExtension(new Twig_Extension_Debug());
$twig->addExtension(new StringExtension());
// Add URL function
$twig->addFunction(
  new Twig_Function('url', function ($sz) {
    return ROOT . '/' . $sz;
  })
);
// Add an asset function
$twig->addFunction(
  new Twig_Function('asset', function ($asset) {
    return ROOT . '/assets' . $asset;
  })
);

// The router
require 'router.php';
