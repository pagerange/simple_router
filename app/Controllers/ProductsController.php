<?php

namespace App\Controllers;

use \App\View;
use \App\Request;

class ProductsController
{

    static public function show($product)
    {
        $title = ucwords(str_replace('-', ' ', $product));
        return View::show('products/show', compact('title'));
    }

    static public function create()
    {
        $title = 'Create Product';
        return View::show('products/create', compact('title'));
    }

    static public function store()
    {
        var_dump(Request::all());
    }


}