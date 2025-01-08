<?php

use App\Controllers;

require_once '../vendor/autoload.php';

$routes = require '../app/config/routes.php';

$uri = trim($_SERVER['REQUEST_URI'], '/');
$uri = parse_url($uri, PHP_URL_PATH);

foreach ($routes as $route => $routeParams) {
    $pattern = '#^' . $route . '$#';
    if (preg_match($pattern, $uri, $matches)) {
        $controllerName = $routeParams['controller'];
        $action = $routeParams['action'];

        $controllerClass = "App\\Controllers\\{$controllerName}";

        if (!class_exists($controllerClass)) {
            http_response_code(404);
            echo "Controller {$controllerName} não encontrado.";
            exit;
        }

        $controllerInstance = new $controllerClass();

        if (!method_exists($controllerInstance, $action)) {
            http_response_code(404);
            echo "Ação {$action} não encontrada no controller {$controllerName}.";
            exit;
        }

        // Executar ação com ou sem parâmetros
        if (isset($matches[1])) {
            $controllerInstance->$action($matches[1]);
        } else {
            $controllerInstance->$action();
        }
        exit;
    }
}

http_response_code(404);
echo "Página não encontrada.";
