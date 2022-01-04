<?php

namespace App;

use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Application;
use App\Service\Router\Constructor as Router;

class Bootstrap
{
    protected
        $di,
        $app,
        $applicationPath,
        $serviceProviders = [];

    public function __construct($applicationPath)
    {
        if (!is_dir($applicationPath)) {
            throw new \InvalidArgumentException('The $applicationPath must be a valid application path');
        }

        $this->di = new FactoryDefault();
        $this->app = new Application($this->di);
        
        $this->applicationPath = $applicationPath;
        $this->registerServices();
        
        $this->app->registerModules(
            require dirname(dirname(__FILE__)) . '/config/module.php'
        );
    }

    public function getDi()
    {
        return $this->di;
    }

    public function getApplicationPath()
    {
        return $this->applicationPath;
    }

    public function run()
    {
        try {
            $response = $this->app->handle($_SERVER['REQUEST_URI']);
            $response->send();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    protected function registerServices()
    {
        $this->di['config'] = require dirname(dirname(__FILE__)) . '/config/main.php';
        $this->di['router'] = new Router($this->di);
    }
}
