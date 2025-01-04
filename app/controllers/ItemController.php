<?php

require_once '../app/models/ItemModel.php';
require_once '../app/models/CollectionModel.php';

class ItemController {
    private $itemModel;
    private $collectionModel;

    public function __construct() {
        $this->itemModel = new ItemModel();
        $this->collectionModel = new CollectionModel();
    }

    public function index() {
        $items = $this->itemModel->getAllItemsWithCollections();
        require '../app/views/itemsView.php';
    }

    public function create() {
        $collections = $this->collectionModel->getAllCollections();
        require '../app/views/itemsCreateView.php';
    }

    public function store() {
        $image = $_FILES['image'];

        $target_dir = "../public/uploads/";
        $target_file = $target_dir . basename($image["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($image["tmp_name"]);
        if ($check === false) {
            die("File is not an image.");
        }

        if (file_exists($target_file)) {
            die("Sorry, file already exists.");
        }

        if ($image["size"] > 5000000) {
            die("Sorry, your file is too large.");
        }

        $allowedFormats = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($imageFileType, $allowedFormats)) {
            die("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
        }

        if (!move_uploaded_file($image["tmp_name"], $target_file)) {
            die("Sorry, there was an error uploading your file.");
        }

        $image_name = basename($image["name"]);

        $data = [
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'collection_id' => $_POST['collection_id'],
            'value' => $_POST['value'],
            'image_url' => $image_name
        ];
        $this->itemModel->createItem($data);
        header('Location: /items');
    }

    public function show($id) {
        $item = $this->itemModel->getItemById($id);
        require '../app/views/itemDetailView.php';
    }
}
?>
