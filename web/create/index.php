<?php

require '../initR.php';

require_once __DIR__ . '/../../vendor/autoload.php';

// defines the web root
define('WEB_ROOT', substr($_SERVER['SCRIPT_NAME'], 0, strpos($_SERVER['SCRIPT_NAME'], '/create/index.php')));
// defindes the path to the files
define('ROOT_PATH', realpath(dirname(__FILE__) . '/../../'));

$router = new Router();

$router->execute($rCreate);

?>

