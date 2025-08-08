<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::login'); // Arahkan root ke login

$routes->get('/login', 'Auth::login');
$routes->post('/auth/authenticate', 'Auth::authenticate');
$routes->get('/auth/forgot-password', 'Auth::forgotPassword');
$routes->get('/logout', 'Auth::logout');
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/absen', 'Dashboard::absen');

#$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth']);
