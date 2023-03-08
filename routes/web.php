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
            '[GET]  http://dummyrest.noorraihan.com/api/product/all            :: get all products',
            '[GET]  http://dummyrest.noorraihan.com/api/product/show/:id       :: get specific product by id',
            '[POST] http://dummyrest.noorraihan.com/api/product/store          :: insert new product',
            '[PUT]  http://dummyrest.noorraihan.com/api/product/update/:id     :: update existed product by id',
            '[DELETE] http://dummyrest.noorraihan.com/api/product/delete/:id   :: delete existed product by id',
            '[DELETE] http://dummyrest.noorraihan.com/api/product/delete/all   :: delete all product'
        ]
    ]);
});


$router->group(['prefix' => 'api'], function () use ($router) {

    $router->get('product/all', ['uses' => 'ProductController@index']);
    $router->post('product/store', ['uses' => 'ProductController@store']);
    $router->get('product/show/{id}', ['uses' => 'ProductController@show']);
    $router->put('product/update/{id}', ['uses' => 'ProductController@update']);
    $router->delete('product/delete/{id}', ['uses' => 'ProductController@destroy']);
    $router->delete('product/delete/all', ['uses' => 'ProductController@destroyAll']);
});