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

$routes->get('personas', 'PersonasController::index');
$routes->get('personas/crear', 'PersonasController::crear');
$routes->post('personas/guardar', 'PersonasController::guardar');
$routes->get('personas/editar/(:num)', 'PersonasController::editar/$1');
$routes->post('personas/actualizar/(:num)', 'PersonasController::actualizar/$1');
$routes->get('personas/eliminar/(:num)', 'PersonasController::eliminar/$1');

$routes->get('usuarios', 'UsuarioController::index');
$routes->get('usuarios/crear', 'UsuarioController::crear');
$routes->post('usuarios/guardar', 'UsuarioController::guardar');
$routes->get('usuarios/editar/(:num)', 'UsuarioController::editar/$1');
$routes->post('usuarios/actualizar/(:num)', 'UsuarioController::actualizar/$1');
$routes->get('usuarios/eliminar/(:num)', 'UsuarioController::eliminar/$1');

$routes->get('reportes/usuarios', 'Reportes\UsuariosReportes::index');
$routes->get('reportes/usuarios/pdf', 'Reportes\UsuariosReportes::pdf');
