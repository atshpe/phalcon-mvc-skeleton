<?php

use App\Service\Acl\Role;

return [
    'base' => [
        '/login' => [
            '*'
        ],
        '/' => [
            Role::USER,
        ],
        '/logout' => [
            Role::USER,
        ],
        '/example' => [
            Role::USER,
        ]
    ],
];
