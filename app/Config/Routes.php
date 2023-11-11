<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->get('/', 'Auth::index');
$routes->get('/user', 'User::index');
$routes->post('/register', 'Auth::register');
$routes->get('/viewregister', 'Auth::viewregister');
$routes->get('/akun', 'User::akun');
$routes->get('/topup', 'User::topup');
$routes->get('/logout', 'User::logout');
$routes->get('/transaction', 'User::transaction');
$routes->post('/authenticate', 'Auth::authenticate');
$routes->post('/updateProfile', 'User::updateProfile');
$routes->post('/updateTopup', 'User::updateTopup');
