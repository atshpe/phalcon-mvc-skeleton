<?php

return [
    'db' => [],
    'router' => [
        '/' => [
            'controller' => 'index',
            'action' => 'index',
        ],
        '/test/{param}' => [
            'controller' => 'index',
            'action' => 'test',
        ],
        '/auth' => [
            'controller' => 'auth',
            'action' => 'index',
        ],
    ],
];
