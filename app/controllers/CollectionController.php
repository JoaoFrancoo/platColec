<?php

namespace App\Controllers;

use App\Models\Collection;
use App\Config\Database;
use App\Models\User;

class CollectionController
{
    private $collectionModel;

    public function __construct()
    {
        $db = new \App\Config\Database();
        $this->collectionModel = new Collection($db->getConnection());
    }

    public function index()
    {
        $collections = $this->collectionModel->getAllCollections();
        $this->renderView('collections/viewCollections', ['collections' => $collections]);
    }

    private function renderView($view, $data = [])
    {
        extract($data);
        require __DIR__ . "/../views/{$view}.php";
    }
}
