<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth']);
$routes->get('/upload', 'Upload::index');

// Auth routes
$routes->get('/', 'Auth::login');
$routes->get('/auth/login', 'Auth::login'); // Add this route to handle both paths
$routes->post('/auth/authenticate', 'Auth::authenticate');
$routes->get('/auth/forgot-password', 'Auth::forgotPassword');
$routes->get('/auth/forgot_password', 'Auth::forgotPassword'); // Add underscore version for consistency
$routes->get('/logout', 'Auth::logout');
