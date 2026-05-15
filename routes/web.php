<?php

declare(strict_types=1);

return [

    'GET' => [

        '/' => [
            'view' => 'index.php'
        ],

        '/dashboard' => [
            'view' => 'dashboard.php'
        ],
    ],

    'POST' => [

        '/login' => [
            'controller' => 'AuthController',
            'method' => 'login'
        ],
    ],
];
