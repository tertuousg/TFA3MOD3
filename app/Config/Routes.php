<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Pages::home');
$routes->get('/about', 'Pages::about');
$routes->get('/customers', 'Customers::index');
$routes->get('/customers/new', 'Customers::new');
$routes->post('/customers', 'Customers::create', ['filter' => 'csrf']);
$routes->get('/customers/(:num)/edit', 'Customers::edit/$1');
$routes->post('/customers/(:num)', 'Customers::update/$1', ['filter' => 'csrf']);
$routes->get('/users', 'Users::index');
$routes->get('/users/new', 'Users::new');
$routes->post('/users', 'Users::create', ['filter' => 'csrf']);
$routes->get('/users/(:num)/edit', 'Users::edit/$1');
$routes->post('/users/(:num)', 'Users::update/$1', ['filter' => 'csrf']);
