<?php

use Phalcon\Mvc\Application;
use Phalcon\Di\FactoryDefault;

$di = new FactoryDefault();

$di->set(
    'config',
    function () {
        return require dirname(dirname(__FILE__)) . '/config/main.php';
    }
);

$di->set(
    'router',
    function () {
        return require dirname(dirname(__FILE__)) . '/config/router.php';
    }
);

$application = new Application($di);
$application->registerModules(
    require dirname(dirname(__FILE__)) . '/config/module.php'
);

try {
    $response = $application->handle($_SERVER['REQUEST_URI']);
    $response->send();
} catch (\Exception $e) {
    echo $e->getMessage();
}
