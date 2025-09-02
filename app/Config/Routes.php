<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('equipos', 'Equipos::index');
$routes->post('equipos/guardar', 'Equipos::guardar');
$routes->get('equipos/editar/(:num)', 'Equipos::editar/$1');
$routes->post('equipos/actualizar/(:num)', 'Equipos::actualizar/$1');
$routes->get('equipos/eliminar/(:num)', 'Equipos::eliminar/$1');
$routes->get('equipos', 'EquiposController::index');
$routes->get('/', 'Home::index');
$routes->post('/validar', 'AuthController::validar');
$routes->get('/dashboard', 'Home::dashboard');
$routes->get('equipos', 'EquiposController::index');

