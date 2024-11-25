<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'LoginController::login');

$routes->get('/login', 'LoginController::login');
$routes->post('/login', 'LoginController::login');
$routes->get('/forgotpwd', 'LoginController::sendLink');
$routes->post('/forgotpwd', 'LoginController::sendLink');
$routes->get('/register', 'LoginController::login');
$routes->post('/register', 'LoginController::register');
$routes->get('/logout', 'LoginController::logout');

$routes->get('/dashboard', 'DashboardController::index');