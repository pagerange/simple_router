<?php

ob_start();
session_start();

require __DIR__ . '/../vendor/autoload.php';

use App\SimpleRouter as Route;


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


// Route filter is like a series of nested seives 
// Catch big routes before short routes with the same patterns

Route::get('products/{store}/{category}/{product}/show', function($store, $category, $product) {
    \App\ProductsController::location($store, $category, $product);
});

Route::get('products/{category}/{product}/show', function($category, $product) {
    \App\ProductsController::category($category, $product);
});

Route::get('products/{product}/show', function($product) {
    \App\ProductsController::show($product);
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


/*  ROUTER
----------------------------------------------------------- */

// Request::init();
Route::init( $_SERVER['REQUEST_METHOD'] );
Route::dispatch( $_SERVER['REQUEST_URI'] );


// flush buffer
ob_flush();