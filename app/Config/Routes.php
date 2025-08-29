<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/equipos', 'Equipo::index');
$routes->get('equipos', 'EquiposController::index');
$routes->get('/', 'Home::index');
$routes->post('/validar', 'AuthController::validar');
$routes->get('/dashboard', 'Home::dashboard');
$routes->get('equipos', 'EquiposController::index');

