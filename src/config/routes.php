<?php

return [
    '/' => [
        'controller' => 'index',
        'action' => 'index'
    ],
    '/login' => [
        'controller' => 'auth',
        'action' => 'index'
    ],
    '/logout' => [
        'controller' => 'auth',
        'action' => 'logout'
    ],
    '/example' => [
        'controller' => 'index',
        'action' => 'example'
    ]
];
