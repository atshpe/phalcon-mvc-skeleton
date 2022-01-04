<?php

namespace App\Module\Main\Controller;

use Phalcon\Mvc\Controller;

class AuthController extends Controller
{
    public function indexAction()
    {
        $this->tag->setTitle('Authentication');
    }
}
