<?php

$routes = [
    'api/profile/edit' => [
        'controller' => 'api',
        'action' => 'profileEdit',
    ],

    'api/pagination' => [
        'controller' => 'api',
        'action' => 'pagination',
    ],

    'api/save/photo' => [
        'controller' => 'api',
        'action' => 'savePhoto',
    ],

    'api/delete/photo' => [
        'controller' => 'api',
        'action' => 'deletePhoto',
    ],

    'api/change/avatar' => [
        'controller' => 'api',
        'action' => 'changeAvatar',
    ],

    'api/change/bg' => [
        'controller' => 'api',
        'action' => 'changeBg',
    ],
];

return $routes;
