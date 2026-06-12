<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/municipios/estado/(:num)', 'Municipios::getByEstado/$1');
$routes->post('/cadastro', 'Cadastro::cadastro');

