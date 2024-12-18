<?php

namespace app\controllers;

use app\models\collection;
use app\models\User;


class CollectionController
{
    private $collectionModel;

    // Injeção de dependência do PDO
    public function __construct($pdo)
    {
        $this->collectionModel = new Collection($pdo);
    }

    // Método para exibir todas as coleções
    public function index()
    {
        $collections = $this->collectionModel->getAllCollections();
        require __DIR__ . '/../views/collections/home.php';
    }

    // Método adicional para exibir uma coleção específica
    public function show($id)
    {
        $collection = $this->collectionModel->getCollectionById($id);

        if (!$collection) {
            echo "Coleção não encontrada.";
            return;
        }

        require __DIR__ . '/../views/collections/viewCollections.php';
    }
}
