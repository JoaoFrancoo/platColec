<?php

return [
    '' => [
        'controller' => 'HomePageController', 
        'action' => 'index' 
    ],
    'colecoes' => [
        'controller' => 'ColecaoController', 
        'action' => 'index' 
    ],
    'colecoes/create' => [
        'controller' => 'ColecaoController', 
        'action' => 'create' 
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
    'item/show/(\d+)' => [
        'controller' => 'ItemController', 
        'action' => 'show' 
    ]
];
?>
