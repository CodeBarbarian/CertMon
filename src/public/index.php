<?php
/**
 * Composer
 */
require dirname(__DIR__) . '/vendor/autoload.php';

/**
 * Error and Exception handling
 */
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

/**
 * Sessions
 */
session_start();

/**
 * Routing
 */
$Router = new Core\Router();

/**
 * Default Route
 */
$Router->add('{controller}/{action}');

/**
 * Add the routes for the Home Controller and the index action
 * */
$Router->add('', ['controller' => 'Home', 'action' => 'index']);
$Router->add('home', ['controller' => 'Home', 'action' => 'index']);

/**
 * Add the routes for the certificates
 */
$Router->add('certificate/delete/{name:[\wa-f]+}', ['controller' => 'Certificate', 'action' => 'delete']);
$Router->add('certificate/delete/confirm/{name:[\wa-f]+}', ['controller' => 'Certificate', 'action' => 'confirm']);
$Router->add('certificate/detail/{name:[\wa-f]+}', ['controller' => 'Certificate', 'action' => 'view']);

/**
 * Cron tasks
 */
$Router->add('tasks/run', ['controller' => 'Tasks', 'action' => 'run']);

/**
 * Execute the dispatch to allow navigation and use the QUERY_STRING for pathing
 * */
$Router->dispatch($_SERVER['QUERY_STRING']);