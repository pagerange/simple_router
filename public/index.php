<?php

require __DIR__ . '/../vendor/autoload.php';

use App\SimpleRouter as Route;
use App\Request;

/* DEFINE THE ROUTES WITH CLOSURES
----------------------------------------------------------- */

// GET routes

Route::get('/', function(){
     var_dump('HOME PAGE ROUTE');
});

Route::get('products', function() {
    \App\ProductsController::index();
});

Route::get('products/create', function(){
    \App\ProductsController::create();
});

Route::get('products/{product}/edit', function($product) {
    \App\ProductsController::edit($product);
 });

Route::get('products/{product}/show', function($product) {
    \App\ProductsController::show($product);
});

Route::get('products/{product}/{category}/show', function($product, $category) {
    \App\ProductsController::category($product, $category);
});

// POST routes

Route::post('products', function() {
    \App\ProductsController::store();
});


// PATCH routes

Route::patch('products', function() {
    \App\ProductsController::update();
});


// DELETE routes

Route::delete('products', function() {
    \App\ProductsController::destroy();
});


/* INITIALIZE REQUEST AND ROUTER
----------------------------------------------------------- */

echo '<pre>';

Request::init();
Route::init(Request::type());
Route::dispatch( Request::uri() );

