<?php

namespace App\Module\Main;

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Di\DiInterface;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface
{
    public function registerAutoloaders(DiInterface $di = null) {}

    public function registerServices(DiInterface $di)
    {
        $di->set(
            'dispatcher',
            function () {
                $dispatcher = new Dispatcher();
                $dispatcher->setDefaultNamespace('App\Module\Main\Controller');

                return $dispatcher;
            }
        );
        
        $di->set(
            'view',
            function () {
                $view = new View();
                $view->setViewsDir('../app/module/main/view/');

                return $view;
            }
        );
    }
}
