<?php
return [
    'default/index' => [
        'controller' => 'main',
        'action' => 'index',
    ],

    'default/setup' =>[
        'controller' => 'main',
        'action' => 'setup',
    ],

    'account/login' =>[
        'controller' => 'account',
        'action' => 'login',
    ],

    'account/confirm' =>[
        'controller' => 'account',
        'action' => 'confirm',
    ],

    'account/signup' =>[
        'controller' => 'account',
        'action' => 'signup',
    ],

    'account/setup' =>[
        'controller' => 'account',
        'action' => 'setup',
    ],

    'new/show' =>[
        'controller' => 'news',
        'action' => 'show',
    ],
];