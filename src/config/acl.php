<?php

use App\Service\Acl\Role;

return [
    'base' => [
        '/auth' => ['*'],
        '/' => [
            Role::USER,
        ],
        '/test/{param}' => [
            Role::TEST,
        ],
    ],
];
