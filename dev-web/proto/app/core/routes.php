<?php
$router  = new Router();

$router->get('/livres', 'LivreController', 'index');
$router->get('/livres/create', 'LivreController', 'create');

$router->get('/', 'AuteurController', 'index');
$router->get('/auteurs/create', 'AuteurController', 'create');
$router->post('/auteurs/store', 'AuteurController', 'store');
$router->get('/auteurs/edit', 'AuteurController', 'edit');
$router->post('/auteurs/update', 'AuteurController', 'update');
$router->post('/auteurs/delete', 'AuteurController', 'delete');

$router->get('/editeurs', 'EditeurController', 'index');
$router->get('/editeurs/create', 'EditeurController', 'create');
$router->post('/editeurs/store', 'EditeurController', 'store');
$router->get('/editeurs/edit', 'EditeurController', 'edit');
$router->post('/editeurs/update', 'EditeurController', 'update');
$router->post('/editeurs/delete', 'EditeurController', 'delete');

$router->get('/etudiants', 'EtudiantController', 'index');
$router->get('/etudiants/create', 'EtudiantController', 'create');
$router->post('/etudiants/store', 'EtudiantController', 'store');
$router->get('/etudiants/edit', 'EtudiantController', 'edit');
$router->post('/etudiants/update', 'EtudiantController', 'update');
$router->post('/etudiants/delete', 'EtudiantController', 'delete');


$router->route();
