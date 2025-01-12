<?php

namespace App\Controllers;

use App\Models\CollectionModel;
use App\Models\ItemModel;
use App\Models\User;
use App\Controllers\AuthController;

class CollectionController
{
    private $collectionModel;
    private $itemModel;
    private $userModel;

    public function __construct()
    {
        $this->collectionModel = new CollectionModel();
        $this->itemModel = new ItemModel();
        $this->userModel = new User();
    }

    public function index()
    {
        if (isset($_GET['categoria_id'])) {
            $categoria_id = $_GET['categoria_id'];
            $collections = $this->collectionModel->getCollectionsByCategoryId($categoria_id);
        } else {
            $collections = $this->collectionModel->getAllCollections();
        }

        // Buscar categorias através do modelo
        $categorias = $this->collectionModel->getCategories();

        require __DIR__ . '/../views/collections/collectionsListView.php';
    }

    public function create()
    {
        $items = $this->itemModel->getItemsWithoutCollection();
        $categorias = $this->collectionModel->getCategories();
        require __DIR__ . '/../views/collections/collectionsCreateView.php';
    }

    public function store()
    {
        $user_id = AuthController::getAuthenticatedUserId();
        $data = [
            'user_id' => $user_id,
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'category_id' => $_POST['category_id'] // Incluindo a categoria na criação da coleção
        ];

        $collection_id = $this->collectionModel->createCollection($data);
        
        // Associar itens à coleção
        if (isset($_POST['items']) && !empty($_POST['items'])) {
            $items = $_POST['items'];
            $this->collectionModel->associateItemsToCollection($collection_id, $items);
        }

        header('Location: /collections');
    }

    public function show($id)
    {
        $collection = $this->collectionModel->getCollectionById($id);
        $items = $this->collectionModel->getItemsByCollectionId($id);
        require __DIR__ . '/../views/collections/collectionsShowView.php';
    }

    public function showCollectionItems($collectionId)
    {
        $items = $this->collectionModel->getItemsByCollectionId($collectionId);
        require __DIR__ . '/../views/collections/collectionsItemsView.php';
    }

    public function profile()
    {
        session_start();

        if (!isset($_SESSION['user_id'])) {
            die("User not authenticated.");
        }

        $user_id = $_SESSION['user_id'];

        // Carregar informações do usuário
        $user = $this->userModel->getUserById($user_id);
        $collections = $this->collectionModel->getCollectionsByUserId($user_id);
        $items = $this->itemModel->getPurchasedItemsByUserId($user_id);
        $wishlistItems = $this->itemModel->getWishlistItems($user_id);

        require __DIR__ . '/../views/profile/profileView.php';
    }

    public function transactionHistory()
    {
        $user_id = AuthController::getAuthenticatedUserId();
        $transactions = $this->itemModel->getTransactionHistoryByUserId($user_id);
        require __DIR__ . '/../views/profile/transactionHistoryView.php';
    }
    public function edit($id)
{
    $collection = $this->collectionModel->getCollectionById($id);
    $categorias = $this->collectionModel->getCategories();
    $itemsWithoutCollection = $this->collectionModel->getItemsWithoutCollectionByUserId(AuthController::getAuthenticatedUserId());
    $itemsInCollection = $this->collectionModel->getItemsByCollectionId($id);
    require __DIR__ . '/../views/collections/edit.php';
}

public function update($id)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'categoria_id' => $_POST['categoria_id']
        ];

        $this->collectionModel->updateCollection($id, $data);

        // Adicionar itens à coleção
        if (isset($_POST['add_items']) && !empty($_POST['add_items'])) {
            foreach ($_POST['add_items'] as $item_id) {
                $this->collectionModel->addItemToCollection($id, $item_id);
            }
        }

        // Remover itens da coleção
        if (isset($_POST['remove_items']) && !empty($_POST['remove_items'])) {
            foreach ($_POST['remove_items'] as $item_id) {
                $this->collectionModel->removeItemFromCollection($id, $item_id);
            }
        }

        header('Location: /collections/show/' . $id);
    }
}
public function delete($id) {
    try {
        $this->collectionModel->deleteCollection($id);
        header('Location: /collections');
    } catch (\Exception $e) {
        error_log('Erro ao eliminar coleção: ' . $e->getMessage());
        die('Erro ao eliminar coleção.');
    }
}

}