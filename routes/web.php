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

// $router->get('/products', function () use ($router) {
//     return $router->get('/products', 'ProductController@getProducts');
// });

$router->group(['prefix' => 'api/', 'middleware' => 'format'], function () use ($router) {
    $router->get('products',  ['uses' => 'ProductController@getProducts']);
    $router->post('cart',  ['uses' => 'CartController@addToCart']);
    //$router->put('cart',  ['uses' => 'ProductController@addToCart']);
    $router->get('cart',  ['uses' => 'CartController@getCart']);
    $router->delete('cart',  ['uses' => 'CartController@deleteCart']);
    $router->get('discount',  ['uses' => 'ProductController@getDiscounts']);
    $router->post('discount',  ['uses' => 'ProductController@addDiscount']);
});
