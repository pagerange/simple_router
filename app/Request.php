<?php

namespace App;

class Request
{

    static protected $uri;
    static protected $post;
    static protected $get;
    static protected $all;
    static protected $type;

    static public function init()
    {
        static::$uri = $_SERVER['REQUEST_URI'];
        static::$post = $_POST;
        static::$get = $_GET;
        static::$all = $_POST + $_GET;
        if(static::has('_method')) {
            static::$type = static::get('_method');
        } else {
            static::$type  = $_SERVER['REQUEST_METHOD'];
        }
    }

    static public function has($key)
    {
        if(array_key_exists($key, static::$all)) {
            return true;
        } else {
            return false;
        }
    }

    static public function get($key)
    {
        if(static::has($key)) {
            return static::$all[$key];
        } else {
            throw new \Exception('No such index');
        }
    }

    static public function all() {
        if(static::$type == 'POST' || static::$type == 'PATCH') {
            return static::$post;
        } else {
            return static::$get;
        }
    }

    static public function uri()
    {
        return static::$uri;
    }

    static public function type()
    {
        return static::$type;
    }

}