<?php

namespace App\Module\Main\Form;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element;

class Login extends Form
{
    public
        $username,
        $password,
        $submit;
    
    public function __construct()
    {
        parent::__construct();

        $this->username = new Element\Text(
            'username',
            [
                'maxLength' => 20,
                'placeholder' => 'Username',
                'class' => 'form-control',
            ]
        );

        $this->password = new Element\Password(
            'password',
            [
                'maxLength' => 30,
                'placeholder' => 'Password',
                'class' => 'form-control',
            ]
        );

        $this->submit = new Element\Submit(
            'submit',
            [
                'value' => 'Log in',
                'class' => 'btn btn-primary'
            ]
        );

        $this->add($this->username);
        $this->add($this->password);
        $this->add($this->submit);
    }
}
