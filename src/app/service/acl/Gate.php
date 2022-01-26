<?php

namespace App\Service\Acl;

use Phalcon\Di\FactoryDefault,
    Phalcon\Acl\Enum,
    Phalcon\Acl\Adapter\Memory;

class Gate
{
    protected
        $config,
        $request,
        $router,
        $session;
    
    public function __construct(FactoryDefault $di)
    {
        $this->config   = $di->get('config')->toArray();
        $this->request  = $di->get('request');
        $this->router   = $di->get('router');
        $this->session  = $di->get('session');
        $this->acl      = new Memory();

        $this->run();
    }

    protected function run()
    {
        $role = $this->session->role ?? Role::GUEST;

        if (! $this->router->wasMatched()) {
            return $this->router->notFound('404');
        }

        $controller = $this->getRoute()->getPaths()['controller'];
        $action = $this->getRoute()->getPaths()['action'];

        $pattern = $this->getRoute()->getPattern();

        if (
            $role == Role::GUEST
            &&
            $pattern != '/login'
        ) {
            header('Location: /login');
            exit;
        }

        $this->build();

        if (! $this->acl->isAllowed($role, $controller, $action)) {
            // implement logic for access denied here

            echo '<center><h1>Access denied</h1></center>';
            exit;
        }
    }

    protected function getRoles()
    {
        $class = new \ReflectionClass(new Role);
        return $class->getConstants();
    }

    protected function build()
    {
        $route = $this->getRoute();
        $pattern = $route->getPattern();

        $controller = $route->getPaths()['controller'];
        $action = $route->getPaths()['action'];

        $this->acl->setDefaultAction(Enum::DENY);

        foreach ($this->getRoles() as $role) {
            $this->acl->addRole($role);
        }

        $this->acl->addComponent(
            $controller,
            $action
        );
        
        $config = $this->config['acl']['base'];

        foreach ($config as $resource => $roles) {
            if ($resource == $pattern) {
                foreach ($roles as $role) {
                    $this->acl->allow(
                        $role,
                        $controller,
                        $action
                    );
                }
            }
        }
    }

    protected function getRoute()
    {
        return $this->router->getMatchedRoute();
    }
}
