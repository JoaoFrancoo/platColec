<?php

require_once __DIR__ . '/../models/collection.php';

class CollectionController
{
    private $collectionModel;

    public function __construct($pdo)
    {
        $this->collectionModel = new Collection($pdo);
    }

    public function index()
    {
        $collections = $this->collectionModel->getAllCollections();
        require __DIR__ . '/../views/collections/index.php';
    }
}
