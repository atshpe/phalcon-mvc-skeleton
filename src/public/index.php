<?php

use App\Bootstrap;

require dirname(dirname(__FILE__)) . '/bootstrap/autoload.php';

function debug($v, $methods = false) {
    echo '<pre>';
    $methods ? var_dump(get_class_methods($v)) : var_dump($v);
    echo '</pre>';
}

$bootstrap = new Bootstrap(dirname(dirname(__FILE__)));
$bootstrap->run();
