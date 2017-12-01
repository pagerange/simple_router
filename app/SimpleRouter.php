<?php

/**
 * SimpleRouter Class
 * A Regular Expression based router for parsing routes and dispatching
 * callables
 * @author steve@pagerange.com <Steve George>
 * @created_at 2017-11-30
 * @updated_at 2017-12-01
 */

namespace App;

class SimpleRouter
{

    static public $type;

    /**
     * Array of callbacks with routes as key
     * @var array
     */
    static private $GET_routes = [];

    /**
     *  Array of regexex and param names with route as key
     * @var array
     */
    static private $GET_regex = [];

    /**
     * Array of callbacks with routes as key
     * @var array
     */
    static private $POST_routes = [];

    /**
     *  Array of regexex and param names with route as key
     * @var array
     */
    static private $POST_regex = [];

    /**
     * Array of callbacks with routes as key
     * @var array
     */
    static private $PATCH_routes = [];

    /**
     *  Array of regexex and param names with route as key
     * @var array
     */
    static private $PATCH_regex = [];

    /**
     * Array of callbacks with routes as key
     * @var array
     */
    static private $DELETE_routes = [];

    /**
     *  Array of regexex and param names with route as key
     * @var array
     */
    static private $DELETE_regex = [];

    /**
     * Initialze the router and set the 
     * regex patterns for all routes
     * @return Void
     */
    static public function init($type)
    {
        static::$type = $type;
        static::setRegex($type);
    }

    /**
     * Set a GET route
     * @param  [String] $route   route with param placeholders
     * @param  [Callable] $callback Callable function or method
     * @return Void
     */
    static public function get($route, $callback)
    {
        static::$GET_routes[$route] = $callback;
    }

    /**
     * Set a POST route
     * @param  [String] $route   route with param placeholders
     * @param  [Callable] $callback Callable function or method
     * @return Void
     */
     static public function patch($route, $callback)
    {
        static::$PATCH_routes[$route] = $callback;
    }

    /**
     * Set a POST route
     * @param  [String] $route   route with param placeholders
     * @param  [Callable] $callback Callable function or method
     * @return Void
     */
     static public function post($route, $callback)
    {
        static::$POST_routes[$route] = $callback;
    }

    /**
     * Set a DELETE route
     * @param  [String] $route   route with param placeholders
     * @param  [Callable] $callback Callable function or method
     * @return Void
     */
     static public function delete($route, $callback)
    {
        static::$DELETE_routes[$route] = $callback;
    }


    /**
     * Set regex pattern for each route and
     * store in the class's regex property
     */
    static public function setRegex()
    {
        $type = static::$type;
        $regex = "{$type}_regex";
        $routes = "{$type}_routes";
        foreach(static::$$routes as $route => $value)
        {
            $route = trim($route, '/');
            $segs = explode('/', $route);
            $reg = '';
            $vars = [];
            for($i = 0; $i< count($segs); $i++)
            {
                if(strpos($segs[$i], '{') !== 0) {
                    $reg .= '(' . $segs[$i] . ')';
                } else {
                    $index = trim($segs[$i], '{}');
                    $vars[$index] = $i + 1;
                    $reg .= '(.+)'; 
                }

                $reg .= '\/';
            }
            $reg = trim($reg, '\/');
            $reg = '/^' . $reg . '$/';
            static::$$regex[$route]['regex'] = $reg;
            static::$$regex[$route]['vars'] = $vars;

        }
    }

    /**
     * Invoke the callable associated with a specific route
     * that matches the request
     * @param  [String] $request [Pulled from $_SERVER['REQUEST_URI']]
     * @return [Callable]  The method or function associated with a route
     */
    static public function dispatch($request) {
        $type = static::$type;
        $regex = "{$type}_regex";
        $routes = "{$type}_routes";
        $params = [];
        if($request == '/') {
                return call_user_func_array(static::$$routes[$request], $params);
        } else {
            foreach(static::$$regex as $key => $route)
            {
                $clean_request = trim($request, '/');
                preg_match($route['regex'], $clean_request, $matches);
                if(isset($matches[0]) && $matches[0] == $clean_request) {
                    foreach($route['vars'] as $index => $var) {
                        $params[$index] = $matches[$var];
                    }
                    return call_user_func_array(static::$$routes[$key], $params);
                } 
            }
        return call_user_func('error_404');
        }

    }

}
