<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'TacheController::index');
$routes->match(['get', 'post'], '/setTriPreference','TacheController::setTriPreference');
