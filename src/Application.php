<?php

namespace MgahedMvc;

use MgahedMvc\Http\Request;
use MgahedMvc\Http\Response;
use MgahedMvc\Http\Route;
use MgahedMvc\Support\Config;

class Application
{
    protected Route $route;
    protected Request $request;
    protected Response $response;
    protected Config $config;

    public function __construct()
    {
        $this->request = new Request;
        $this->response = new Response;
        $this->route = new Route($this->request, $this->response);
        $this->config = new Config($this->loadConfig());
    }

    protected function loadConfig()
    {
        foreach(scandir(config_path()) as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }
            $fileName = explode('.', $file)[0];
            yield $fileName => require config_path($file);
        }

    }


    public function run()
    {
        $this->route->resolve();
    }

    /**
     * @throws \Exception
     */
    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        } else {
            throw new \Exception("Property $name does not exist");
        }
    }
}