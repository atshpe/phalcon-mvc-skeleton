<?php

namespace App\Module\Main\Controller;

use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
    public function notFoundAction()
    {
        $this->tag->setTitle('404');
        echo '<center><h1>404</h1></center>';
    }
    
    public function indexAction()
    {
        $this->view->username = $this->session->username;
        $this->tag->setTitle('Main');
    }

    public function testAction()
    {
        $param = $this->dispatcher->getParams();
        var_dump($param);die;
    }
}
