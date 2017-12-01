<?php

use \App\SimpleRouter as Route;

Route::get('/', function(){
     var_dump('HOME PAGE ROUTE');
});

Route::get('products', function() {
    \App\Controllers\ProductsController::index();
});

Route::get('products/{product}/edit', function($product) {
    \App\Controllers\ProductsController::edit($product);
 });


Route::get('products/create', function(){
    \App\Controllers\ProductsController::create();
});

Route::get('products/{product}', function($product) {
    \App\Controllers\ProductsController::show($product);
});


Route::post('products', function() {
    \App\Controllers\ProductsController::store();
});

Route::patch('products', function() {
    \App\Controllers\ProductsController::update();
});

Route::delete('products', function() {
    \App\Controllers\ProductsController::destroy();
});


