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

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('users', ['uses' => 'UserController@index', 'as' => 'user.index']);
    $router->post('users', ['uses' => 'UserController@create', 'as' => 'user.create']);
    $router->get('users/{id}', ['uses' => 'UserController@show', 'as' => 'user.show']);
    $router->put('users/{id}', ['uses' => 'UserController@update', 'as' => 'user.update']);
    $router->delete('users/{id}', ['uses' => 'UserController@destroy', 'as' => 'user.destroy']);
});
