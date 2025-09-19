<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| URI ROUTING
|--------------------------------------------------------------------------
| Register web routes for your application.
|--------------------------------------------------------------------------
*/

# Default route → Create User
$router->match('/', 'UserController::create', ['GET', 'POST']);

# Users routes
$router->get('/users/view', 'UserController::view');
$router->match('/users/create', 'UserController::create', ['GET', 'POST']);
$router->match('/users/update/{id}', 'UserController::update', ['GET', 'POST']);
$router->match('/users/delete/{id}', 'UserController::delete', ['GET', 'POST']);
