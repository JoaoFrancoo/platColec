<?php

$routes = require '../app/config/routes.php';
$uri = trim($_SERVER['REQUEST_URI'], '/');

foreach ($routes as $route => $routeParams) {
    // Verifique se a rota corresponde a um padrão dinâmico
    $pattern = '#^' . $route . '$#';
    if (preg_match($pattern, $uri, $matches)) {
        $controller = $routeParams['controller'];
        $action = $routeParams['action'];

        require_once "../app/controllers/$controller.php";
        $controllerInstance = new $controller();

        // Passe o ID capturado para o método do controlador
        if (isset($matches[1])) {
            $controllerInstance->$action($matches[1]);
        } else {
            $controllerInstance->$action();
        }
        exit;
    }
}

// Exiba uma mensagem de erro se a rota não for encontrada
echo "Página não encontrada";
?>
