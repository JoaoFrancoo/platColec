<?php

namespace App\Controllers;

use App\Models\CollectionModel;

class CollectionController {
    private $collectionModel;

    

    public function __construct() {
        $this->collectionModel = new CollectionModel();
    }

    public function index() {
        $collections = $this->collectionModel->getAllCollections();
        require __DIR__ . '/../views/collections/collectionsView.php';
    }

    public function create() {
        require __DIR__ . '/../views/collections/collectionsCreateView.php';
    }

    public function store() {
        $data = [
            'user_id' => $_POST['user_id'],
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'users' => $_POST['users']
        ];
        $this->collectionModel->createCollection($data);
        header('Location: /collections');
    }

    public function show($id) {
        $collection = $this->collectionModel->getCollectionById($id);
        require __DIR__ . '/../views/collections/collectionDetailView.php';
    }
}
?>
