<?php

use App\Http\Controllers\ProductController;
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

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });


$router->group(['prefix' => 'api'], function () use ($router) {

    $router->get('product/all', ['uses' => 'ProductController@index']);
    $router->post('product', ['uses' => 'ProductController@store']);
    $router->get('product/{id}', ['uses' => 'ProductController@show']);
    $router->put('product/{id}', ['uses' => 'ProductController@update']);
    $router->delete('product/{id}', ['uses' => 'ProductController@destroy']);
    $router->delete('product/all', ['uses' => 'ProductController@destroyAll']);
});