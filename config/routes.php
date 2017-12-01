<?php

use \App\SimpleRouter as Route;

Route::get('products/{product}/edit', function($product) {
    $title = ucwords(str_replace('-', ' ', $product));
    echo "<h1>Editing: $title</h1>";
    });

Route::get('products/create', function(){
    \App\Controllers\ProductsController::create();
});

Route::post('products', function() {
    \App\Controllers\ProductsController::store();
});

Route::get('books/{id}', function($id) {
    echo "<h1>Showing book with ID of $id</h1>";
    });

Route::get('products/{product}/show', function($product) {
    \App\Controllers\ProductsController::show($product);
});

Route::get('cars/{make}/{model}/{year}', 'showCar');

Route::get('/', function(){
     var_dump('HOME PAGE ROUTE');
});
