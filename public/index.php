<?php

use App\Core\Router;

// Carrega o autoload do Composer (se usar namespaces)
require_once __DIR__ . '/../vendor/autoload.php';

// Carrega as rotas
$routes = require_once __DIR__ . '/../app/config/routes.php';

// Inicializa o roteador
$router = new Router($routes);

// Captura a URL atual
$url = $_GET['url'] ?? '';

// Despacha a rota
$router->dispatch($url);
