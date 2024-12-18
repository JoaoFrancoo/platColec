<?php

namespace App\Core;

class Router
{
    private $routes;

    public function __construct($routes)
    {
        $this->routes = $routes;
    }

    public function match($url)
    {
        $url = trim($url, '/'); // Remove barras no início/fim da URL
        return $this->routes[$url] ?? false;
    }

    public function dispatch($url)
    {
        $route = $this->match($url);

        if ($route) {
            $controllerName = 'App\\Controllers\\' . $route['controller'];
            $action = $route['action'];

            if (class_exists($controllerName)) {
                $controller = new $controllerName();

                if (method_exists($controller, $action)) {
                    $controller->$action();
                    return;
                } else {
                    echo "Erro 404: Método <strong>$action</strong> não encontrado no controlador <strong>$controllerName</strong>.";
                }
            } else {
                echo "Erro 404: Controlador <strong>$controllerName</strong> não existe.";
            }
        } else {
            echo "Erro 404: Rota não encontrada!";
        }
    }
}
