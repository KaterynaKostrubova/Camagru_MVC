<?php
return [
    'default/index' => [
        'controller' => 'main',
        'action' => 'index',
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

    'account/checkemail' =>[
        'controller' => 'account',
        'action' => 'checkemail',
    ],
];