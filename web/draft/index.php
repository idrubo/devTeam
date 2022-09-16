<?php

require 'initR.php';

// defines the web root
define('WEB_ROOT', substr($_SERVER['SCRIPT_NAME'], 0, strpos($_SERVER['SCRIPT_NAME'], '/draft/index.php')));
// defindes the path to the files
define('ROOT_PATH', realpath(dirname(__FILE__) . '/../../'));

/* DEBUG */ msgToConsole ('Into draft/index.php');
/* DEBUG */ varToConsole ('WEB_ROOT', WEB_ROOT);
/* DEBUG */ varToConsole ('ROOT_PATH', ROOT_PATH);

$router = new Router();

/* DEBUG */ varToConsole ('routes', $rIndex);

$router->execute($rIndex);

?>
