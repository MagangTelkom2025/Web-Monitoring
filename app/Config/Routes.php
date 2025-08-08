<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Dashboard::index'); // Halaman utama dashboard

$routes->get('/login', 'Auth::login');
$routes->post('/auth/authenticate', 'Auth::authenticate');
$routes->get('/auth/forgot-password', 'Auth::forgotPassword');
$routes->get('/logout', 'Auth::logout');
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/absen', 'Dashboard::absen');

$routes->get('ticket', 'Tickets::index');           // List view
$routes->post('ticket/datatable', 'Tickets::getDataTable'); // AJAX DataTable
$routes->get('tickets/upload', 'Tickets::uploadForm'); // Form upload
$routes->post('tickets/upload', 'Tickets::upload');    // Proses upload
$routes->get('ticket/upload-progress/(:num)', 'Tickets::uploadProgress/$1'); // Progress page
$routes->get('ticket/upload-status/(:num)', 'Tickets::getUploadStatus/$1'); // API status

#$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth']);
