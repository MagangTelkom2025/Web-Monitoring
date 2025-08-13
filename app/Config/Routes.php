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
//$routes->get('/absen', 'Absen::index');

// $routes->get('ticket', 'Tickets::index');           // List view

$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('/ticket', 'Tickets::index');
    $routes->get('/absen', 'Absen::index');
    $routes->get('tickets/upload', 'Tickets::uploadForm'); // Form upload

    $routes->post('tickets/upload', 'Tickets::upload');    // Proses upload
    $routes->get('tickets/ajaxList', 'Tickets::ajaxList');
    $routes->get('tickets/getCategoriesByMain', 'Tickets::getCategoriesByMain');

    $routes->get('absen/uploadaux', 'Absen::uploadForm'); // Form upload

});
