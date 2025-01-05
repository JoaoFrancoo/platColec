<?php

require_once '../app/models/CollectionsModel.php';

class CollectionController {
    private $collectionModel;

    public function __construct() {
        $this->collectionModel = new CollectionModel();
    }

    public function index() {
        $collections = $this->collectionModel->getAllCollections();
        require '../app/views/collectionsView.php';
    }

    public function create() {
        require '../app/views/collectionsCreateView.php';
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
        require '../app/views/collectionDetailView.php';
    }
}
?>
