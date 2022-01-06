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
        $this->build();
    }

    public function build()
    {
        $this->setDefaults([
            'module' => 'main',
            'controller' => 'index',
            'action' => 'notFound'
        ]);

        $config = $this->di->get('config')->toArray();
        $config = $config['router'];

        foreach ($config as $route => $items) {
            $this->add($route, $items);
        }
    }
}
