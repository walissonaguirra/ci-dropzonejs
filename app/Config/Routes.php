<?php

use CodeIgniter\Router\RouteCollection;

$routes->get('/', 'PageController::home');
$routes->post('/upload', 'PageController::upload', [ 'as' => 'upload']);
$routes->delete('/delete/(:num)', 'PageController::delete/$1', [ 'as' => 'delete']);
