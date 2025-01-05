<?php

$routes = require '../app/config/routes.php';
$uri = trim($_SERVER['REQUEST_URI'], '/');

foreach ($routes as $route => $routeParams) {
    $pattern = '#^' . $route . '$#';
    if (preg_match($pattern, $uri, $matches)) {
        $controllerName = $routeParams['controller'];
        $action = $routeParams['action'];

        require_once "../app/controllers/{$controllerName}.php";

        $controllerClass = "App\\controllers\\{$controllerName}";
        $controllerInstance = new $controllerClass();

        if (isset($matches[1])) {
            $controllerInstance->$action($matches[1]);
        } else {
            $controllerInstance->$action();
        }
        exit;
    }
}

echo "Página não encontrada";
?>
