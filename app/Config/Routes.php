<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('cadastro', 'ClienteController::create', ['as' => 'cadastro']);
$routes->post('store', 'ClienteController::store', ['as' => 'store']);

$routes->get('/', 'ClienteController::read', ['as' => 'clientes']);
$routes->get('list', 'ClienteController::read', ['as' => 'list']);

$routes->get('edit/(:num)', 'ClienteController::edit/$1', ['as' => 'edit']);
$routes->put('edit/(:num)', 'ClienteController::update/$1', ['as' => 'update']);

$routes->delete('delete/(:num)', 'ClienteController::delete/$1', ['as' => 'delete']);

$routes->get('/municipios/estado/(:num)', 'Municipios::getByEstado/$1', );

// crud cliente
$routes->post('cliente/delete/(:num)', 'Cliente::delete/$1');

