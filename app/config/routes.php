<?php

return [
    '' => [
        'controller' => 'HomePageController',
        'action' => 'index'
    ],
    'register' => [
        'controller' => 'AuthController',
        'action' => 'register'
    ],
    'login' => [
        'controller' => 'AuthController',
        'action' => 'login'
    ],
    'logout' => [
        'controller' => 'AuthController',
        'action' => 'logout'
    ],
    'collections' => [
        'controller' => 'CollectionController',
        'action' => 'index'
    ],
    'collections/create' => [
        'controller' => 'CollectionController',
        'action' => 'create'
    ],
    'collections/store' => [
        'controller' => 'CollectionController',
        'action' => 'store'
    ],
    'collections/show/(\d+)' => [
        'controller' => 'CollectionController',
        'action' => 'show'
    ],
    'items' => [
        'controller' => 'ItemController',
        'action' => 'index'
    ],
    'items/create' => [
        'controller' => 'ItemController',
        'action' => 'create'
    ],
    'items/store' => [
        'controller' => 'ItemController',
        'action' => 'store'
    ],
    'items/show/(\d+)' => [
        'controller' => 'ItemController',
        'action' => 'show'
    ]
];
