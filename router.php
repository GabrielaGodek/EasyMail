<?php
// Lib used: https://phprouter.com/
function get($route, $path_to_include)
{
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		route($route, $path_to_include);
	}
}
function any($route, $path_to_include)
{
	route($route, $path_to_include);
}
function route($route, $path_to_include)
{
	$callback = $path_to_include;

	if (!is_callable($callback)) {
		
		if (!strpos($path_to_include, '.php')) {
			$path_to_include .= '.php';
		}
	}
	if ($route == "/404") {
		include_once __DIR__ . "/$path_to_include";
		exit();
	}
	$request_url = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
	$request_url = rtrim($request_url, '/');
	$request_url = strtok($request_url, '?');
	$route_parts = explode('/', $route);
	$request_url_parts = explode('/', $request_url);
	array_shift($route_parts);
	array_shift($request_url_parts);

	if ($route_parts[0] == '' && count($request_url_parts) == 0) {
		
		// Callback function
		if (is_callable($callback)) {
			call_user_func_array($callback, []);
			exit();
		}
		echo __DIR__ . "/$path_to_include";
		include_once __DIR__ . "/$path_to_include";
		exit();
	}
	if (count($route_parts) != count($request_url_parts)) {
		return;
	}
	$parameters = [];
	for ($__i__ = 0; $__i__ < count($route_parts); $__i__++) {
		$route_part = $route_parts[$__i__];
		if (preg_match("/^[$]/", $route_part)) {
			$route_part = ltrim($route_part, '$');
			array_push($parameters, $request_url_parts[$__i__]);
			$$route_part = $request_url_parts[$__i__];
		} else if ($route_parts[$__i__] != $request_url_parts[$__i__]) {
			return;
		}
	}
	// Callback function
	if (is_callable($callback)) {
		call_user_func_array($callback, $parameters);
		exit();
	}
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	include __DIR__ . "$path_to_include";
	exit();
}