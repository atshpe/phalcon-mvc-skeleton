<?php

namespace App;

use Phalcon\Di\FactoryDefault,
    Phalcon\Mvc\Application,
    Phalcon\Config,
    App\Service\Session\Storage,
    App\Service\Router\Constructor as RouterConstructor;

class Bootstrap
{
    protected
        $di,
        $app,
        $applicationPath;

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
            require $this->applicationPath . '/config/module.php',
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
        $this->di['config']     = new Config(require $this->applicationPath . '/config/main.php');
        $this->di['router']     = new RouterConstructor($this->di);
        $this->di['session']    = new Storage($this->applicationPath);
    }
}
