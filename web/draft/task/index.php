<?php

require '../initR.php';

// defines the web root
define('WEB_ROOT', substr($_SERVER['SCRIPT_NAME'], 0, strpos($_SERVER['SCRIPT_NAME'], '/draft/task/index.php')));
// defindes the path to the files
define('ROOT_PATH', realpath(dirname(__FILE__) . '/../../../'));

/* DEBUG */ varToConsole ('WEB_ROOT +++', WEB_ROOT);
/* DEBUG */ varToConsole ('ROOT_PATH', ROOT_PATH);

$router = new Router();

/* DEBUG */ varToConsole ('routes', $rTask);

$router->execute($rTask);

?>
