<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'LoginController::login');

$routes->match(['get', 'post'], '/login', 'LoginController::login');

$routes->get('/register', 'LoginController::login');
$routes->post('/register', 'LoginController::register');
$routes->get('/logout', 'LoginController::logout');

$routes->get('/dashboard', 'TacheController::index');
$routes->match(['get', 'post'], '/setTriPreference','TacheController::setTriPreference');
$routes->post( '/ajouterTache','TacheController::ajouterTache');