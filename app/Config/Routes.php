<?php

use CodeIgniter\Router\RouteCollection;

$routes->get('/', 'PageController::home');
$routes->post('/upload', 'ImageController::upload', [ 'as' => 'upload']);
$routes->delete('/delete/(:num)', 'ImageController::delete/$1', [ 'as' => 'delete']);
