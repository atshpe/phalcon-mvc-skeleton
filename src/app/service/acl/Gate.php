<?php

namespace App\Service\Acl;

use Phalcon\Di\FactoryDefault;
use Phalcon\Acl\Enum;
use Phalcon\Acl\Adapter\Memory;

class Gate extends Memory
{
    protected
        $config,
        $request,
        $session;
    
    public function __construct(FactoryDefault $di)
    {
        $this->config = $di->get('config');
        $this->request = $di->get('request');
        $this->session = $di->get('session');
        
        $this->run();
    }

    public function run()
    {
        $role = $this->session->role ?? Role::GUEST;
        $uri = $this->request->getURI();
        
        if (
            $role == Role::GUEST
            &&
            $uri != '/auth'
        ) {
            header('Location: /auth');
        }

        $this->setDefaultAction(Enum::DENY);
    }
}
