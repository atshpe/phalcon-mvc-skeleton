<?php

namespace App\Module\Main;

use Phalcon\Loader,
    Phalcon\Mvc\View,
    Phalcon\Di\DiInterface,
    Phalcon\Mvc\Dispatcher,
    Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface
{
    public function registerAutoloaders(DiInterface $di = null)
    {
        $loader = new Loader();

        $loader->registerNamespaces([
            'App\Module\Main\Controller'    => dirname(dirname(__FILE__)) . '/main/controller/',
            'App\Module\Main\Model'         => dirname(dirname(__FILE__)) . '/main/model/',
        ]);
        
        $loader->register();
    }

    public function registerServices(DiInterface $di)
    {
        $di['dispatcher'] = function () {
            $dispatcher = new Dispatcher();
            $dispatcher->setDefaultNamespace('App\Module\Main\Controller');

            return $dispatcher;
        };

        $di['view'] = function () {
            $view = new View();
            $view->setViewsDir('../app/module/main/view/');

            return $view;
        };
    }
}
