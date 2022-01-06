<?php

namespace App\Module\Main\Controller;

use Phalcon\Mvc\Controller;

class AuthController extends Controller
{
    public function indexAction()
    {
        $this->tag->setTitle('Authentication');
        
        if ($this->session->has('role')) {
            return $this->response->redirect('/');
        }

        if ($this->request->isPost()) {
            $data = $this->request->getPost();

            $this->session->username = $data['username'];
            $this->session->role = 'User';

            return $this->response->redirect('/');
        }
    }
}
