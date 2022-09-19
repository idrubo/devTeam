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
	'/'     => 'tupdt#index'
);

$rTask = array(
	'/task/' => 'tupdt#task');

$rTaskUD = array(
	'/taskUD/' => 'tupdt#taskUD');

$rList = array(
	'/list/' => 'tupdt#list');

$rListV = array(
	'/listV/' => 'tupdt#listV');

?>
