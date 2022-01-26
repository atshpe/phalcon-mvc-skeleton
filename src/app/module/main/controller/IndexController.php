<?php

namespace App\Module\Main\Controller;

use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
    public function notFoundAction()
    {
        $this->response->setStatusCode(404, 'Not found');
        $this->response->setContent('The page doesn\'t exist');
        $this->response->send();
        exit;
    }
    
    public function indexAction()
    {
        $this->view->username = $this->session->username;
        $this->tag->setTitle('Main');
    }

    public function exampleAction()
    {
        $this->tag->setTitle('Example');
    }
}
