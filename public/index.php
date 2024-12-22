<?php

session_start();
require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;

// Carrega as rotas
$routes = require __DIR__ . '/../app/config/routes.php';

// Inicializa o roteador
$router = new Router($routes);

// Captura a URL atual
$url = $_GET['url'] ?? '';

// Despacha a rota
$router->dispatch($_GET['$url']??'');
