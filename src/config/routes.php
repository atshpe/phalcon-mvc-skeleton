<?php

return [
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
    '/logout' => [
        'controller' => 'auth',
        'action' => 'logout'
    ],
];
