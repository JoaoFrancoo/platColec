<?php

namespace App\Controllers;

use App\Models\ItemModel;

class ItemController
{
    private $itemModel;

    public function __construct()
    {
        $this->itemModel = new ItemModel();
    }

    public function index()
    {
        $items = $this->itemModel->getAllItems();
        require __DIR__ . '/../views/items/itemsListView.php';
    }

    public function create()
    {
        require __DIR__ . '/../views/items/itemsCreateView.php';
    }

    public function store()
    {
        session_start();
        
        if (!isset($_SESSION['user_id'])) {
            die("User not authenticated.");
        }

        $user_id = $_SESSION['user_id'];
        $collection_id = isset($_POST['collection_id']) && !empty($_POST['collection_id']) ? $_POST['collection_id'] : null;
        $stock = isset($_POST['stock']) && !empty($_POST['stock']) ? $_POST['stock'] : 1;

        $image = $_FILES['image'];
        $target_dir = __DIR__ . '/../../public/uploads/';
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
            'collection_id' => $collection_id,
            'user_id' => $user_id,
            'value' => $_POST['value'],
            'image_url' => $image_name,
            'stock' => $stock
        ];

        $this->itemModel->createItem($data);
        header('Location: /items');
    }

    public function edit($id)
    {
        $item = $this->itemModel->getItemById($id);
        require __DIR__ . '/../views/items/itemsEditView.php';
    }

    public function update()
    {
        session_start();

        if (!isset($_SESSION['user_id'])) {
            die("User not authenticated.");
        }

        $user_id = $_SESSION['user_id'];
        $item_id = $_POST['item_id'];
        $data = [
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'value' => $_POST['value'],
            'stock' => $_POST['stock']
        ];

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image = $_FILES['image'];
            $target_dir = __DIR__ . '/../../public/uploads/';
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

            $data['image_url'] = basename($image["name"]);
        }

        $this->itemModel->updateItem($item_id, $data);
        header('Location: /market/items');
    }

    public function buy()
    {
        session_start();
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['user_id']) && isset($_POST['item_id'])) {
                $user_id = $_POST['user_id'];
                $item_id = $_POST['item_id'];

                try {
                    if ($this->itemModel->buyItem($user_id, $item_id)) {
                        echo 'Compra realizada com sucesso!';
                    } else {
                        echo 'Estoque insuficiente ou erro na compra.';
                    }
                } catch (\Exception $e) {
                    echo $e->getMessage();
                }
            } else {
                echo 'Dados de compra incompletos.';
            }
        } else {
            echo 'Método de requisição inválido.';
        }
    }

    public function showMarketItems()
    {
        $items = $this->itemModel->getAllItems();
        require __DIR__ . '/../views/market/marketItemsView.php';
    }
    public function show($id)
{
    $item = $this->itemModel->getItemById($id);
    
    if (!$item) {
        die('Item não encontrado');
    }

    // Obtenha o nome da coleção
    $collectionName = $this->itemModel->getCollectionNameById($item['collection_id']);

    $data = [
        'item' => $item,
        'collectionName' => $collectionName
    ];

    require __DIR__ . '/../views/items/itemDetailView.php';
}

}
