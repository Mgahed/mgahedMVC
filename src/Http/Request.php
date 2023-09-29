<?php

namespace MgahedMvc\Http;
class Request
{
    public function method(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function path()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        return str_contains($path, '?') ? explode('?', $path)[0] : $path;
    }

    public function all()
    {
        return array_merge($_GET, $_POST);
    }

    public function get($key)
    {
        return $_GET[$key] ?? null;
    }

    // add new value to $_GET
    public function addValue($key, $value)
    {
        $_GET[$key] = $value;
    }

    // update value in $_GET
    public function updateValue($key, $value)
    {
        $_GET[$key] = $value;
    }
}