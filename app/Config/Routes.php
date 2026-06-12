<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/municipios/estado/(:num)', 'Municipios::getByEstado/$1');
$routes->post('/cadastro', 'Cadastro::cadastro');

// Rota para exibir a lista de clientes
$routes->get('/clientes', 'Cliente::index');
$routes->post('cliente/delete/(:num)', 'Cliente::delete/$1');

