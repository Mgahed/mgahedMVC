<?php

use MgahedMvc\Application;
use MgahedMvc\Support\Hash;
use MgahedMvc\View\View;

if (!function_exists('env')) {
    function env($key, $default = null)
    {
        return $_ENV[$key] ?? value($default);
    }
}

if (!function_exists('bcrypt')) {
    function bcrypt($value)
    {
        return Hash::make($value);
    }
}

// config
if (!function_exists('config')) {
    function config($key, $default = null)
    {
        return app()->config->get($key, $default);
    }
}

if (!function_exists('class_basename')) {
    function class_basename($class)
    {
        $class = is_object($class) ? get_class($class) : $class;
        return basename(str_replace('\\', '/', $class));
    }
}

if (!function_exists('app')) {
    function app(): ?Application
    {
        static $instance = null;
        if (!$instance) {
            $instance = new Application;
        }
        return $instance;
    }
}

if (!function_exists('value')) {
    function value($value)
    {
        return $value instanceof Closure ? $value() : $value;
    }
}

if (!function_exists('base_path')) {
    function base_path($path = '')
    {
        return dirname(__DIR__) . '/../' . $path;
    }
}

if (!function_exists('config_path')) {
    function config_path($path = '')
    {
        return base_path('config/' . $path);
    }
}

if (!function_exists('view_path'))
{
    function view_path($path = '')
    {
        return base_path('views/' . $path);
    }
}

if (!function_exists('view'))
{
    function view($view, $params = [])
    {
        return View::make($view, $params);
    }
}

if (!function_exists('responseJson'))
{
    function responseJson($data, $code = 200)
    {
        http_response_code($code);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}

// camelCase to snake_case
if (!function_exists('camelToSnake')) {
    function camelToSnake($input)
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $input));
    }
}