<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->post('/login', ['as' => 'login', 'uses' => 'AuthenticationController@login']);
$router->post('/register', ['as' => 'register', 'uses' => 'AuthenticationController@register']);

$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->post('/logout', ['as' => 'logout', 'uses' => 'AuthenticationController@logout']);
    $router->get('/user', ['as' => 'user.index', 'uses' => 'UserController@index']);
    $router->post('/user', ['as' => 'user.store', 'uses' => 'UserController@store']);
    $router->get('/user/{id}', ['as' => 'user.show', 'uses' => 'UserController@show']);
    $router->put('/user/{id}', ['as' => 'user.update', 'uses' => 'UserController@update']);
    $router->delete('/user/{id}', ['as' => 'user.destroy', 'uses' => 'UserController@destroy']);
});
