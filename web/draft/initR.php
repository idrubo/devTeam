<?php

error_reporting(E_ALL|E_STRICT);
ini_set('display_errors', 1);
date_default_timezone_set('CET');

// defines the path to the files
define('INCLUDE_PATH', realpath(dirname(__FILE__) . '/../../'));

/* For debugging: */ require INCLUDE_PATH . '/lib/debug/toConsole.php';
/* DEBUG */ varToConsole ('INCLUDE_PATH', INCLUDE_PATH);

// starts the session
session_start();

// includes the system routes. Define your own routes in this file
include(INCLUDE_PATH . '/config/routes.php');

/**
 * Standard framework autoloader
 * @param string $className
 */
function autoloader($className) {

	$root_path = realpath(dirname(__FILE__) . '/../../');
	$cms_path = $root_path . '/lib/base/';

	// controller autoloading
	if (strlen($className) > 10 && substr($className, -10) == 'Controller') {
		if (file_exists($root_path . '/app/controllers/' . $className . '.php') == 1) {
			require_once $root_path . '/app/controllers/' . $className . '.php';
		}
	}
	else {
		if (file_exists($cms_path . $className . '.php')) {
			require_once $cms_path . $className . '.php';
		}
		else if (file_exists($root_path . '/lib/' . $className . '.php')) {
			require_once $root_path . '/lib/' . $className . '.php';
		}
		else {
			require_once $root_path . '/app/models/'.$className.'.php';
		}
	}
}

// activates the autoloader
spl_autoload_register ('autoloader');
?>
