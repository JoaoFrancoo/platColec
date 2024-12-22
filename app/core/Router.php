<?php

namespace App\Core;

use App\Config\Database;
use App\Controllers\CollectionController;
use App\Controllers\AuthController;

class Router
{
    private $routes;
    private $pdo;

    public function __construct($routes)
    {
        $this->routes = $routes;

        // Inicialize a conexão com o banco de dados
        $db = new Database();
        $this->pdo = $db->getConnection();
    }

    public function dispatch($url)
    {
        if (!isset($this->routes[$url])) {
            http_response_code(404);
            echo "Página não encontrada.";
            return;
        }

        $route = $this->routes[$url];
        $controllerName = 'app\\controllers\\' . $route['controller'];
        $action = $route['action'];

        // Instancia o controlador passando o $pdo
        $controller = new \App\Controllers\CollectionController($this->pdo);

        if (!method_exists($controller, $action)) {
            http_response_code(404);
            echo "Ação não encontrada.";
            return;
        }

        $controller->$action();
    }
}
