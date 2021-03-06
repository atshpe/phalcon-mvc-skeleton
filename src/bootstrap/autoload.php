<?php

use Phalcon\Loader;

$loader = new Loader();
$loader->registerNamespaces([
    'App'                           => dirname(dirname(__FILE__)) . '/app/',
    'App\Service'                   => dirname(dirname(__FILE__)) . '/app/service/',
    'App\Service\Session'           => dirname(dirname(__FILE__)) . '/app/service/session/',
    'App\Service\Router'            => dirname(dirname(__FILE__)) . '/app/service/router/',
    'App\Service\Acl'               => dirname(dirname(__FILE__)) . '/app/service/acl/',
]);

$loader->register();
