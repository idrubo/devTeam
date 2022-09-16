<?php 

/**
 * Used to define the routes in the system.
 * 
 * A route should be defined with a key matching the URL and an
 * controller#action-to-call method. E.g.:
 * 
 * '/' => 'index#index',
 * '/calendar' => 'calendar#index'
 */

$routes = array(
	'/' => 'test#index');

# $rIndex = array (
#	'/draft/'     => 'draft#index',
#	'/draft/index.php'     => 'draft#index'
# );

$rIndex = array (
	'/draft/'     => 'draft#index'
);

$rTask = array(
	'/draft/task/' => 'draft#task');

$rTaskUD = array(
	'/draft/taskUD/' => 'draft#taskUD');

$rList = array(
	'/draft/list/' => 'draft#list');

$rListV = array(
	'/draft/listV/' => 'draft#listV');

?>
