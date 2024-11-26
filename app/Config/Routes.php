<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'LoginController::redirect');

$routes->get('/login', 'LoginController::login');
$routes->post('/login', 'LoginController::login');

$routes->get('/forgotpwd', 'LoginController::forgotpwd');
$routes->post('/forgotpwd', 'LoginController::forgotpwd');

$routes->get('/resetpwd/(:any)', 'LoginController::resetpwd/$1');
$routes->post('/resetpwd/(:any)', 'LoginController::resetpwd/$1');


$routes->get('/register', 'LoginController::login');
$routes->post('/register', 'LoginController::register');

$routes->get('/logout', 'LoginController::logout');

$routes->get('/dashboard', 'DashboardController::index');