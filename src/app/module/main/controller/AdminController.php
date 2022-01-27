<?php

namespace App\Module\Main\Controller;

use Phalcon\Mvc\Controller;

class AdminController extends Controller
{
    public function indexAction()
    {
        $this->tag->setTitle('Admin page');
    }
}
