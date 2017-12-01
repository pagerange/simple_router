<?php

require __DIR__ . '/../vendor/autoload.php';

use App\SimpleRouter as Route;
use App\Request;

/* DEFINE THE ROUTES WITH CLOSURES
----------------------------------------------------------- */

Route::get('/', function(){
     var_dump('HOME PAGE ROUTE');
});

Route::get('products', function() {
    \App\ProductsController::index();
});

Route::get('products/{product}/edit', function($product) {
    \App\ProductsController::edit($product);
 });

Route::get('products/create', function(){
    \App\ProductsController::create();
});

Route::get('products/{product}', function($product) {
    \App\ProductsController::show($product);
});

Route::post('products', function() {
    \App\ProductsController::store();
});

Route::patch('products', function() {
    \App\ProductsController::update();
});

Route::delete('products', function() {
    \App\ProductsController::destroy();
});


/* INITIALIZE REQUEST AND ROUTER
----------------------------------------------------------- */

Request::init();
Route::init(Request::type());
Route::dispatch( Request::uri() );

