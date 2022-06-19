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
 * Execute the dispatch to allow navigation and use the QUERY_STRING for pathing
 * */
$Router->dispatch($_SERVER['QUERY_STRING']);