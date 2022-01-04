
<?php

use Phalcon\Loader;

$loader = new Loader();
$loader->registerNamespaces([
    'App'                           => dirname(dirname(__FILE__)) . '/app/',
    'App\Service'                   => dirname(dirname(__FILE__)) . '/app/service/',
    'App\Service\Router'            => dirname(dirname(__FILE__)) . '/app/service/router',
    'App\Module\Main'               => dirname(dirname(__FILE__)) . '/app/module/main/',
    'App\Module\Main\Controller'    => dirname(dirname(__FILE__)) . '/app/module/main/controller/',
    'App\Module\Main\Model'         => dirname(dirname(__FILE__)) . '/app/module/main/model/',
]);

$loader->register();
