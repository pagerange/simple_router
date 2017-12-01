<?php

/**
 * SimpleRequest manager to manage request and various user input
 * For testing SimpleRouter
 */

namespace App;

class Request
{

    /**
     * Raw REQUEST_URI from $_SERVER
     * @var [String]
     */
    static protected $uri;

    /**
     * Raw $_POST array
     * @var [Array]
     */
    static protected $post;

    /**
     * Raw $_GET array
     * @var [Array]
     */
    static protected $get;

    /**
     * All combined $_POST and $_GET vars
     * @var [Array]
     */
    static protected $all;

    /**
     * Request Method, from $_SERVER['REQUEST_METHOD'] or Form input
     * @var [String]
     */
    static protected $type;

    /**
     * Initialize Request and set all properties
     * Also set Request Type
     * @return [type] [description]
     */
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

    /**
     * Test if Request has a variable set
     * @param  [String]  $key [key to test]
     * @return boolean
     */
    static public function has($key)
    {
        if(array_key_exists($key, static::$all)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get var from Request
     * @param  [String] $key [the var to get]
     * @return [Mixed]      [the value of the var if it is set]
     */
    static public function get($key)
    {
        if(static::has($key)) {
            return static::$all[$key];
        } else {
            throw new \Exception('No such index');
        }
    }

    /**
     * Get all Request vars, $_POST and $_GET
     * @return [Array] [All vars]
     */
    static public function all() {
        if(static::$type == 'POST' || static::$type == 'PATCH') {
            return static::$post;
        } else {
            return static::$get;
        }
    }

    /**
     * Return the REQUEST_URI
     * @return [String] [Request YRU]
     */
    static public function uri()
    {
        return static::$uri;
    }

    /**
     * Get the Request type
     * @return [String] [The Request Method]
     */
    static public function type()
    {
        return static::$type;
    }

}