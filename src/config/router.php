<?php

use Phalcon\Mvc\Router;

$router = new Router(false);

$router->setDefaultModule('main');
$router->setDefaultController('index');
$router->setDefaultAction('notFound');

$config = $this->get('config')->toArray();
$config = $config['router'];

foreach ($config as $route => $items) {
    $router->add($route, $items);
}

return $router;
