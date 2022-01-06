<?php

namespace App;

use Phalcon\Di\FactoryDefault,
    Phalcon\Mvc\Application,
    Phalcon\Config,
    Phalcon\Events\Event,
    Phalcon\Events\Manager as EventsManager,
    App\Service\Session\Storage,
    App\Service\Acl\Gate,
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

        $this->attachEvents();
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
        $di = $this->di;
        $appPath = $this->applicationPath;
        
        $this->di->set('config', function () use ($appPath){
            return new Config(require $appPath . '/config/main.php');
        });
        
        $this->di->set('router', function () use ($di){
            return new RouterConstructor($di);
        });
        
        $this->di->set('session', function () use ($appPath) {
            return new Storage($appPath);
        });
        
        $this->di->set('acl', function () use ($di) {
            return (new Gate($di))->run();
        });
    }

    protected function attachEvents()
    {
        $eventsManager = new EventsManager();
        
        $eventsManager->attach(
            'application:beforeHandleRequest',
            function (Event $event) {
                return $this->di->get('acl');
            }
        );

        $this->app->setEventsManager($eventsManager);
    }
}
