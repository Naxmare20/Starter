<?php
session_start();

require '../src/config/config.php';
require '../vendor/autoload.php';

// instance of the Router
$router = new App\Router($_SERVER['REQUEST_URI']);

// homepage
$router->get('/', "UserController@index");

/***
 * Routes pour les utilisateurs
 */
// Route pour afficher le formulaire d'inscription
$router->get('/register', 'UserController@registerForm');

// Route pour traiter l'inscription
$router->post('/register', 'UserController@registerUser');

$router->run();
