<?php

use Phalcon\Loader;

$loader = new Loader();
$loader->registerNamespaces(
    [
        'App\Module\Main\Controller' => dirname(dirname(__FILE__)) . '/app/module/main/controller/',
        'App\Module\Main\Model'      => dirname(dirname(__FILE__)) . '/app/module/main/model/',
    ]
);

$loader->register();
