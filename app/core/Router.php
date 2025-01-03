<?php

namespace App\Core;

class Router
{
    protected $routes;

    public function __construct($routes)
    {
        $this->routes = $routes;
    }

    public function dispatch($url)
    {
        // Verifica se a URL corresponde a uma rota definida
        if (array_key_exists($url, $this->routes)) {
            $controller = $this->routes[$url]['controller'];
            $action = $this->routes[$url]['action'];

            // Carrega o controlador e chama a ação
            require_once __DIR__ . '/../controllers/' . $controller . '.php';
            $controllerInstance = new $controller();
            $controllerInstance->$action();
        } else {
            echo 'Página não encontrada';
        }
    }
}
