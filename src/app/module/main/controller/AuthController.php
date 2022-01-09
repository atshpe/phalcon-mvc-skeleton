<?php

namespace App\Module\Main\Controller;

use Phalcon\Mvc\Controller;
use App\Module\Main\Model\User;

class AuthController extends Controller
{
    public function indexAction()
    {
        $this->tag->setTitle('Authentication');
        
        if ($this->session->has('role')) {
            return $this->response->redirect('/');
        }

        if ($this->request->isPost()) {
            $user = new User();
            
            $item = $user->findFirstByUsername(
                $this->request->get('username')
            );
            
            if ($item) {

                $item = $item->toArray();
                $user->assign($item);

                if ($user->isValidPassword(
                    $this->request->get('password')
                )) {
                    $this->session->id = $item['id'];
                    $this->session->username = $item['username'];
                    $this->session->role = $item['role'];
                    
                    return $this->response->redirect('/');
                } else {
                    $this->view->error = [
                        'msg' => 'Wrong password',
                        'username' => $this->request->get('username'),
                        'password' => $this->request->get('password'),
                    ];
                }
            } else {
                $this->view->error = [
                    'msg' => 'User not found',
                    'username' => $this->request->get('username'),
                ];
            }
        }
    }

    public function logoutAction()
    {
        $this->session->destroy();
        return $this->response->redirect('/auth');
    }
}
