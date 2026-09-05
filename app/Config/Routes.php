<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::store');

$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::authenticate');

$routes->get('/logout', 'Auth::logout');

$routes->get('/tasks', 'Tasks::index', ['filter' => 'auth']);
$routes->get('/tasks/create', 'Tasks::create', ['filter' => 'auth']);
$routes->post('/tasks/store', 'Tasks::store', ['filter' => 'auth']);

$routes->get('/tasks/edit/(:num)', 'Tasks::edit/$1', ['filter' => 'auth']);
$routes->post('/tasks/update/(:num)', 'Tasks::update/$1', ['filter' => 'auth']);
$routes->post('/tasks/delete/(:num)', 'Tasks::delete/$1', ['filter' => 'auth']);

$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth']);
$routes->get('/reports', 'Reports::index', ['filter' => 'auth']);
$routes->get('/reports/pdf', 'Reports::pdf', ['filter' => 'auth']);

$routes->get('/profile', 'Profile::index', ['filter' => 'auth']);
$routes->get('/profile/edit', 'Profile::edit', ['filter' => 'auth']);
$routes->post('/profile/update', 'Profile::update', ['filter' => 'auth']);

$routes->get('/profile/password', 'Profile::password', ['filter' => 'auth']);
$routes->post('/profile/password/update', 'Profile::updatePassword', ['filter' => 'auth']);