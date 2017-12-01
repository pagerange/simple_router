<?php

require __DIR__ . '/../vendor/autoload.php';
require (__DIR__ . '/../config/routes.php');
require (__DIR__ . '/../app/lib/functions.php');

use App\SimpleRouter;
use App\Request;
Request::init();
SimpleRouter::init(Request::type());


/**
 * To Test: visit thie page with a request:
 * http://localhost:8080/cars/honda/civic/2017
 * Register more routes in web.php
 */

SimpleRouter::dispatch( Request::uri() );