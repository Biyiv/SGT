<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'LoginController::redirect');

$routes->match(['get', 'post'], '/login', 'LoginController::login');


$routes->get('/sendActiveMail', 'LoginController::sendActiveMail');
$routes->get('/active/(:any)', 'LoginController::activation/$1');


$routes->match(['get', 'post'], '/forgotpwd', 'LoginController::forgotpwd');

$routes->match(['get', 'post'], '/resetpwd/(:any)', 'LoginController::resetpwd/$1');

$routes->get('/register', 'LoginController::login');
$routes->post('/register', 'LoginController::register');

$routes->get('/logout', 'LoginController::logout');

$routes->get('/dashboard', 'TacheController::index');
$routes->match(['get', 'post'], '/setTriPreference','TacheController::setTriPreference');
$routes->match(['get', 'post'], '/recherche','TacheController::setRecherche');
$routes->post( '/ajouterTache','TacheController::ajouterTache');
$routes->post( '/modifProfil/(:any)','LoginController::modifProfil/$1');

$routes->post('/taches/(:num)', 'TacheController::modifierTache/$1');

$routes->match(['get', 'post'], '/taches/(:num)/commentaires', 'TacheController::supprimerCommentaire/$1');

$routes->post('/supprimerTache/(:num)', 'TacheController::supprimerTache/$1');

$routes->post('/taches/(:num)/ajouterCommentaire', 'TacheController::ajouterCommentaire/$1');
$routes->delete('/taches/supprimerCommentaires/(:num)', 'TacheController::supprimerCommentaire/$1');


//Cette route renvoie vers la méthode pour envoyer les notifications par mail des taches en retard
//$routes->get('/envoyerNotificationParMail', 'EmailNotificationController::envoyerNotificationParMail');
