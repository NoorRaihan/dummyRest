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

$router->get('/', function () use ($router) {
    return response()->json([
        'title' => 'Dummy RestApi for Newbies',
        'parameter' => [
            'name   : String',
            'desc   : String',
            'price  : double/integer',
            'stock  : integer'
        ],
        'api_list' => [
            '[GET]  http://dummyrest.noorraihan.com/api/product/all     :: get all products',
            '[GET]  http://dummyrest.noorraihan.com/api/product/:id     :: get specific product by id',
            '[POST] http://dummyrest.noorraihan.com/api/product         :: insert new product',
            '[PUT]  http://dummyrest.noorraihan.com/api/product/:id     :: update existed product by id',
            '[DELETE] http://dummyrest.noorraihan.com/api/product/:id   :: delete existed product by id',
            '[DELETE] http://dummyrest.noorraihan.com/api/product/all   :: delete all product'
        ]
    ]);
});


$router->group(['prefix' => 'api'], function () use ($router) {

    $router->get('product/all', ['uses' => 'ProductController@index']);
    $router->post('product', ['uses' => 'ProductController@store']);
    $router->get('product/{id}', ['uses' => 'ProductController@show']);
    $router->put('product/{id}', ['uses' => 'ProductController@update']);
    $router->delete('product/{id}', ['uses' => 'ProductController@destroy']);
    $router->delete('product/all', ['uses' => 'ProductController@destroyAll']);
});