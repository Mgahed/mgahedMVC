<?php

namespace MgahedMvc;

use MgahedMvc\Database\DB;
use MgahedMvc\Database\Managers\MySQLManager;
use MgahedMvc\Database\Managers\SQLiteManager;
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
    protected DB $db;

    public function __construct()
    {
        $this->request = new Request;
        $this->response = new Response;
        $this->route = new Route($this->request, $this->response);
        $this->config = new Config($this->loadConfig());
        $this->db = new DB($this->getDatabaseDriver());
    }

    protected function getDatabaseDriver()
    {
        $driver = env('DB_DRIVER');

        switch ($driver) {
            case 'mysql':
                return new MySQLManager();
                break;

            // Uncomment this block if you want to support 'sqlite'
            // case 'sqlite':
            //     return new SQLiteManager();
            //     break;

            default:
                return new MySQLManager();
        }
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
        $this->db->init();
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