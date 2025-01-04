<?php

require_once '../app/models/ItemModel.php';

class ItemController {
    private $model;

    public function __construct() {
        $this->model = new ItemModel();
    }

    public function index() {
        $items = $this->model->getAllItems();
        require '../app/views/itemsView.php';
    }

    public function create() {
        require '../app/views/itemsCreateView.php';
    }

    public function store() {
        $data = [
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'collection_id' => $_POST['collection_id'],
            'value' => $_POST['value'],
            'image_url' => $_POST['image_url']
        ];
        $this->model->createItem($data);
        header('Location: /items');
    }
}
?>
