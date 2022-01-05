<?php

namespace App\Service\Router;

use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Router;

class Constructor extends Router
{
    protected $di;

    public function __construct(FactoryDefault $di)
    {
        parent::__construct(false);

        $this->di = $di;
        $this->setDefault();
        $this->build();
    }

    public function build()
    {
        $config = $this->di->get('config')->toArray();
        $config = $config['router'];

        foreach ($config as $route => $items) {
            $this->add($route, $items);
        }
    }

    private function setDefault()
    {
        $this->setDefaultModule('main');
        $this->setDefaultController('index');
        $this->setDefaultAction('notFound');
    }
}
