<?php

/**
 * Sample controller for testing SimpleRouter
 */

namespace App\Controllers;

use \App\View;
use \App\Request;

class ProductsController
{

    /**
     * Standard list view of products
     * @return [View] [index view]
     */
    static public function index()
    {
        $title = 'Products';
        return View::show('products/index', compact('title'));
    }

    /**
     * Standard detail view of one prooduct
     * @param  [String] $product [product slug]
     * @return [View]          [show view]
     */
    static public function show($product)
    {
        $title = ucwords(str_replace('-', ' ', $product));
        return View::show('products/show', compact('title'));
    }

    /**
     * Standard edit form of existing product
     * @param  [String] $product [slug]
     * @return [View]  [edit view]
     */
    static public function edit($product)
    {
        $title = 'Edit Product: ' . $product;
        return View::show('products/edit', compact('title'));
    }

    /**
     * Standard create view for product
     * @return [View] [create view]
     */
    static public function create()
    {
        $title = 'Create Product';
        return View::show('products/create', compact('title'));
    }

    /**
     * Standard store method
     * @return [View] [index view]
     */
    static public function store()
    {
       $title = 'Product successfully added!';
       return View::show('products/index', compact('title'));
    }

    /**
     * Standard update method
     * @return [View] [index view]
     */
    static public function update()
    {
       $title = 'Product successfully updated!';
       return View::show('products/index', compact('title'));
    }

    /**
     * Standard delete method
     * @return [View] [index view]
     */
    static public function destroy()
    {
       $title = 'Product successfully deleted: ' . Request::get('id');
       return View::show('products/index', compact('title'));
    }


}