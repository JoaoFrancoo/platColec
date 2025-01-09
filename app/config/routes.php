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
    'collection/show/(\d+)' => [
        'controller' => 'CollectionController',
        'action' => 'show'
    ],
    'collections/(\d+)/items' => [
        'controller' => 'CollectionController',
        'action' => 'showCollectionItems'
    ],
    'profile' => [
        'controller' => 'CollectionController',
        'action' => 'profile'
    ],
    'profile/transactions' => [
        'controller' => 'CollectionController',
        'action' => 'transactionHistory'
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
    ],
    'market/items' => [
        'controller' => 'ItemController',
        'action' => 'showMarketItems'
    ],
    'items/edit/(\d+)' => [
        'controller' => 'ItemController',
        'action' => 'edit'
    ],
    'items/update' => [
        'controller' => 'ItemController',
        'action' => 'update'
    ],
    'market/buy' => [
        'controller' => 'ItemController',
        'action' => 'buy'
    ]
];
