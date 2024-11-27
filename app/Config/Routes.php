<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'LoginController::redirect');

$routes->get('/login', 'LoginController::login');
$routes->post('/login', 'LoginController::login');


$routes->get('/sendActiveMail', 'LoginController::sendActiveMail');
$routes->get('/active/(:any)', 'LoginController::activation/$1');

$routes->get('/forgotpwd', 'LoginController::forgotpwd');
$routes->post('/forgotpwd', 'LoginController::forgotpwd');

$routes->get('/resetpwd/(:any)', 'LoginController::resetpwd/$1');
$routes->post('/resetpwd/(:any)', 'LoginController::resetpwd/$1');


$routes->get('/register', 'LoginController::login');
$routes->post('/register', 'LoginController::register');

$routes->get('/logout', 'LoginController::logout');

$routes->get('/dashboard', 'TacheController::index');
$routes->match(['get', 'post'], '/setTriPreference','TacheController::setTriPreference');
$routes->match(['get', 'post'], '/recherche','TacheController::setRecherche');
$routes->match(['get', 'post'], '/resetRecherche','TacheController::resetRecherche');
$routes->post( '/ajouterTache','TacheController::ajouterTache');
$routes->post( '/modifProfil/(:any)','LoginController::modifProfil/$1');

$routes->post('/taches/(:num)', 'TacheController::modifierTache/$1');

$routes->get('/taches/(:num)/commentaires', 'TacheController::getCommentaires/$1');
$routes->post('/taches/(:num)/commentaires', 'TacheController::ajouterCommentaire/$1');