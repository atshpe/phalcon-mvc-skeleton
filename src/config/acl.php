<?php

use App\Service\Acl\Role;

return [
    'base' => [
        '/login' => [
            '*'
        ],
        '/' => [
            Role::USER,
            Role::ADMIN,
        ],
        '/logout' => [
            Role::USER,
            Role::ADMIN,
        ],
        '/example' => [
            Role::USER,
            Role::ADMIN,
        ],
        '/admin' => [
            Role::ADMIN,
        ],
    ],
];
