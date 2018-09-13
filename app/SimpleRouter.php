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

use \App\View;

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
     *  Array of regexes and param names with route as key
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
            // route with slashes trimmed
            $route = trim($route, '/');

            // array of the route segments
            $segs = explode('/', $route);

            // the regex that will match the route
            $reg = '';

            // the params in each route
            $vars = [];

            // define which segments are parameters
            // and assign a simple regex to match them
            for($i = 0; $i< count($segs); $i++)
            {
                // If the segment does not begin with
                // a curly bracket in position zero
                // it is NOT a parameter, and we can
                // simply match it with a capture group
                // that equals the segments string value
                if(strpos($segs[$i], '{') !== 0) {
                    // set the regex as a capture group
                    // of the segment value
                    $reg .= '(' . $segs[$i] . ')';
                } else {
                    // if the segment DOES begin with
                    // a curly bracket, it must be a param
                    // So... trim the curly brackets and 
                    // set a simple regex to match any param
                    // value... (.+)
                    $index = trim($segs[$i], '{}');
                    $vars[$index] = $i + 1;
                    $reg .= '(.+)'; 
                }
                // we need to add a literal slash between segments in
                // the regex, of course, to match slases in the URI
                $reg .= '\/';
            }

            // Trim any slashes from front and back
            $reg = trim($reg, '\/');

            // Add the opening an ending anchors to the regex
            $reg = '/^' . $reg . '$/';

            // Set the regex for a specific route
            static::$$regex[$route]['regex'] = $reg;

            // Set the expected params for a sepcific route
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
                // handle a request for the home page... 
                return call_user_func_array(static::$$routes[$request], $params);
        } else {
            // match the request against a regex
            foreach(static::$$regex as $key => $route)
            {
                // trim slashes from request
                $clean_request = trim($request, '/');

                // attempt to match request agains regex for routes
                preg_match($route['regex'], $clean_request, $matches);

                // If it matches
                if(isset($matches[0]) && $matches[0] == $clean_request) {
                    // build the parameter array
                    foreach($route['vars'] as $index => $var) {
                        $params[$index] = $matches[$var];
                    }
                    // call the method associated with the route
                    // and pass it the params
                    return call_user_func_array(static::$$routes[$key], $params);
                } 
            }
        // else call the error 404 method
        return View::show('error_404');

        }

    }

    // for testing only
    static public function getRegex()
    {
        return self::$GET_regex;
    }

}
