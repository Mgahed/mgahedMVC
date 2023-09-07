<?php

namespace MgahedMvc\Http;

use MgahedMvc\View\View;

class Route
{

    public Request $request;
    public Response $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * @description These methods will be called when the user calls a route
     */
    public static array $routes = [];

    public static function get($route, $action)
    {
        self::$routes['get'][$route] = $action;
    }

    public static function post($route, $action)
    {
        self::$routes['post'][$route] = $action;
    }

    public static function put($route, $action)
    {
        self::$routes['put'][$route] = $action;
    }

    public static function delete($route, $action)
    {
        self::$routes['delete'][$route] = $action;
    }
    // End type of requests

    /**
     * @description Resolve the route
     */
    public function resolve()
    {
        $path = $this->request->path();
        $method = $this->request->method();
        $action = self::$routes[$method][$path] ?? false;

        if (!$action) {
            View::makeError('404');
        }

        // callback
        if (is_callable($action) && !is_array($action)) {
            call_user_func_array($action, []);
        }

        // array
        if (is_array($action)) {
            $controller = new $action[0]();
            $method = $action[1];
            call_user_func_array([$controller, $method], []);
        }
    }
}