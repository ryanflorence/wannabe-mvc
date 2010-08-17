<?php

// get to the root directory
chdir(dirname(__file__)); chdir('..');

// bootstrap the framework schtuffz
require_once('framework/boot/boot.php');

// session
session_start();
// make a token for database interactions
$_SESSION['token'] = make_token();

// load get vars
$param_controller = $_GET['controller'];
$param_action = $_GET['action'];

// load helpers todo: make this in the controller's context?
require_once('app/helpers/application_helper.php');
require_once('app/helpers/' . $param_controller . '_helper.php');

// instantiate the controller
$controller_string = Inflector::camelize($param_controller) . 'Controller';
$controller = new $controller_string($param_action);

// call the action
$controller->$param_action();
