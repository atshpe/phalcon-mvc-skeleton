<?php

namespace App\Service\Session;

use Phalcon\Session\Manager;
use Phalcon\Session\Adapter\Stream;

class Storage extends Manager
{
    public function __construct($dir)
    {
        parent::__construct();

        $adapter = new Stream(['savePath' => $dir . '/cache']);
        $adapter->gc(1800);
        
        $this->setAdapter($adapter);
        $this->start();
    }
}
