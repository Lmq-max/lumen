<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/index','User\IndexController@index');
$router->get('/info','User\IndexController@info');
$router->get('/abc','User\IndexController@abc');
$router->post('/aaa','User\IndexController@aaa');
$router->post('/u/l','User\IndexController@login');
$router->get('/uCenter','User\IndexController@uCenter');