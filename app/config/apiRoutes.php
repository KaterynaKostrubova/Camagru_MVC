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
];

return $routes;
