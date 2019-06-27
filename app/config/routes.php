<?php
return [
    'default/index' => [
        'controller' => 'main',
        'action' => 'index',
    ],

    'default/profile' => [
        'controller' => 'main',
        'action' => 'profile',
    ],

    'account/logout' => [
        'controller' => 'account',
        'action' => 'logout',
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

    'account/changepass' =>[
        'controller' => 'account',
        'action' => 'changepass',
    ],

    'account/newpass' =>[
        'controller' => 'account',
        'action' => 'newpass',
    ],

    'account/confirmpass' =>[
        'controller' => 'account',
        'action' => 'confirmpass',
    ],

    'account/checkemail' =>[
        'controller' => 'account',
        'action' => 'checkemail',
    ],
];