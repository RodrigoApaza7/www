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