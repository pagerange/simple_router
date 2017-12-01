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

    /**
     * Array of callbacks with routes as key
     * @var array
     */
    static private $routes = [];

    /**
     *  Array of regexex and param names with route as key
     * @var array
     */
    static private $regex = [];

    /**
     * Initialze the router and set the 
     * regex patterns for all routes
     * @return Void
     */
    static public function init()
    {
        static::setRegex();
    }

    /**
     * Set a GET route
     * @param  [String] $route   route with param placeholders
     * @param  [Callable] $callback Callable function or method
     * @return Void
     */
    static public function get($route, $callback)
    {
        static::$routes[$route] = $callback;
    }

    /**
     * Set a POST route
     * @param  [String] $route   route with param placeholders
     * @param  [Callable] $callback Callable function or method
     * @return Void
     */
     static public function post($route, $callback)
    {
        static::$routes[$route] = $callback;
    }

    /**
     * Get the routes array
     * @return [Array] All registered routes
     */
    static public function routes()
    {
        return static::$routes;
    }

    /**
     * Set regex pattern for each route and
     * store in the class's regex property
     */
    static public function setRegex()
    {
        foreach(static::routes() as $route => $value)
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
            static::$regex[$route]['regex'] = $reg;
            static::$regex[$route]['vars'] = $vars;
        }
    }

    /**
     * Invoke the callable associated with a specific route
     * that matches the request
     * @param  [String] $request [Pulled from $_SERVER['REQUEST_URI']]
     * @return [Callable]  The method or function associated with a route
     */
    static public function dispatch($request) {
        foreach(static::$regex as $key => $route)
        {
            $clean_request = trim($request, '/');
            preg_match($route['regex'], $clean_request, $matches);
            $params = [];
            if(isset($matches[0]) && $matches[0] == $clean_request) {
                foreach($route['vars'] as $index => $var) {
                    $params[$index] = $matches[$var];
                }
                return call_user_func_array(static::routes()[$key], $params);
            }  elseif($request == '/') {
                return call_user_func_array(static::routes()[$request], $params);
            }
        }
        return call_user_func('error_404');
    }

}
