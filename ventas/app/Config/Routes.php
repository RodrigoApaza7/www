<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// =======================
// RUTAS PÚBLICAS
// =======================
$routes->get('/', 'AuthController::index');
$routes->get('login', 'AuthController::index');
$routes->post('login/autenticar', 'AuthController::autenticar');
$routes->get('logout', 'AuthController::logout');


// =======================
// RUTAS PROTEGIDAS (LOGIN)
// =======================
$routes->group('', ['filter' => 'auth'], function ($routes) {

    // Dashboard
    $routes->get('dashboard', 'DashboardController::index');

    // Personas
    $routes->get('personas', 'PersonasController::index');
    $routes->get('personas/crear', 'PersonasController::crear');
    $routes->post('personas/guardar', 'PersonasController::guardar');
    $routes->get('personas/editar/(:num)', 'PersonasController::editar/$1');
    $routes->post('personas/actualizar/(:num)', 'PersonasController::actualizar/$1');
    $routes->get('personas/eliminar/(:num)', 'PersonasController::eliminar/$1');

    // Productos
    $routes->get('productos', 'ProductosController::index');
    $routes->get('productos/crear', 'ProductosController::crear');
    $routes->post('productos/guardar', 'ProductosController::guardar');
    $routes->get('productos/editar/(:num)', 'ProductosController::editar/$1');
    $routes->post('productos/actualizar/(:num)', 'ProductosController::actualizar/$1');
    $routes->get('productos/eliminar/(:num)', 'ProductosController::eliminar/$1');
});


// =======================
// SOLO ADMIN
// =======================
$routes->group('usuarios', ['filter' => 'auth:admin'], function ($routes) {
    $routes->get('/', 'UsuarioController::index');
    $routes->get('crear', 'UsuarioController::crear');
    $routes->post('guardar', 'UsuarioController::guardar');
    $routes->get('editar/(:num)', 'UsuarioController::editar/$1');
    $routes->post('actualizar/(:num)', 'UsuarioController::actualizar/$1');
    $routes->get('eliminar/(:num)', 'UsuarioController::eliminar/$1');
});

$routes->group('reportes', ['filter' => 'auth:admin,vendedor'], function ($routes) {
    $routes->get('usuarios', 'Reportes\UsuariosReportes::index');
    $routes->get('usuarios/filtrar', 'Reportes\UsuariosReportes::filtrar');
    $routes->get('usuarios/pdf', 'Reportes\UsuariosReportes::pdf');
});

$routes->group('reportes', ['filter' => 'auth:admin,vendedor'], function ($routes) {
    $routes->get('productos', 'Reportes\ProductosReportes::index');
    $routes->get('productos/filtrar', 'Reportes\ProductosReportes::filtrar');
    $routes->get('productos/pdf', 'Reportes\ProductosReportes::pdf');
}); 