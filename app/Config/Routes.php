<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/municipios/estado/(:num)', 'Municipios::getByEstado/$1');

$routes->get('cadastro', 'ClienteController::create', ['as' => 'cadastro']);
$routes->post('store', 'ClienteController::store', ['as' => 'store']);

$routes->get('/', 'ClienteController::read', ['as' => 'clientes']);
$routes->get('list', 'ClienteController::read', ['as' => 'list']);

$routes->get('editar/(:num)', 'ClienteController::edit/$1');
$routes->post('editar/(:num)', 'ClienteController::update/$1');

$routes->post('delete/(:num)', 'ClienteController::delete/$1');
