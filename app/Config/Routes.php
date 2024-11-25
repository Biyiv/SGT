<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'LoginController::login');
$routes->get('/login', 'LoginController::login');
$routes->post('/login', 'LoginController::login');
