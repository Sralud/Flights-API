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

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/flights', 'FlightController@index');
    $router->get('/flights/{id}', 'FlightController@show');
    $router->get('/flights/search', 'FlightController@search');
    $router->post('/flights', 'FlightController@store');
    $router->put('/flights/{id}', 'FlightController@update');
    $router->delete('/flights/{id}', 'FlightController@destroy');
});