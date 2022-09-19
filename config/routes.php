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

$rIndex = array (
	'/'     => 'draft#index'
);

$rTask = array(
	'/task/' => 'draft#task');

$rTaskUD = array(
	'/taskUD/' => 'draft#taskUD');

$rList = array(
	'/list/' => 'draft#list');

$rListV = array(
	'/listV/' => 'draft#listV');

?>
