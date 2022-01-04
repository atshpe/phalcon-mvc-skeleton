<?php

use App\Bootstrap;

require dirname(dirname(__FILE__)) . '/bootstrap/autoload.php';

$bootstrap = new Bootstrap(dirname(dirname(__FILE__)));
$bootstrap->run();
