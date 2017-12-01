<?php

function error_404()
{
    header("HTTP/1.0 404 Not Found");
    echo '<h1>404 Error - Page not found</h1>';
}

function createProduct() 
{
    var_dump('PRODUCT CREATE ROUTE');
}

function showCar($make, $model, $year)
{
    echo "<h1>$year $make $model</h1>";
}