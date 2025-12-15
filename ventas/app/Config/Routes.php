<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::index');
$routes->get('login', 'AuthController::index');
$routes->post('login/autenticar', 'AuthController::autenticar');

$routes->get('dashboard', 'DashboardController::index');
$routes->get('logout', 'AuthController::logout');


$routes->get('personas', 'PersonasController::index_CRUD_personas');
$routes->get('personas/crear', 'PersonasController::crear');
$routes->post('personas/guardar', 'PersonasController::guardar');
$routes->get('personas/editar/(:num)', 'PersonasController::editar/$1');
$routes->post('personas/actualizar/(:num)', 'PersonasController::actualizar/$1');
$routes->get('personas/eliminar/(:num)', 'PersonasController::eliminar/$1');