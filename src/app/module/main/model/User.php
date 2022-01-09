<?php

namespace App\Module\Main\Model;

use Phalcon\Mvc\Model;
use Phalcon\Crypt;

class User extends Model
{
    public
        $id,
        $username,
        $password,
        $role;

    public function initialize()
    {
        $this->setSource('users');
        $this->setConnectionService('db\phalcon\local');
    }

    public function crypt()
    {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
        return $this;
    }

    public function isValidPassword($password)
    {
        return password_verify($password, $this->password);
    }

    public function setRole($role) {
        $this->role = $role;
        return $this;
    }
}
