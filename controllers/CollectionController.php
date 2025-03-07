<?php

namespace App\Controllers;

use App\Models\CollectionModel;
use App\Models\ItemModel;
use App\Controllers\AuthController;

class CollectionController
{
    private $collectionModel;
    private $itemModel;

    public function __construct()
    {
        $this->collectionModel = new CollectionModel();
        $this->itemModel = new ItemModel();
    }

    public function index()
    {
        $collections = $this->collectionModel->getAllCollections();
        require __DIR__ . '/../views/collections/collectionsListView.php';
    }

    public function create()
    {
        $items = $this->itemModel->getItemsWithoutCollection();
        require __DIR__ . '/../views/collections/collectionsCreateView.php';
    }

    public function store()
    {
        $user_id = AuthController::getAuthenticatedUserId();
        $data = [
            'user_id' => $user_id,
            'name' => $_POST['name'],
            'description' => $_POST['description']
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
        $user_id = AuthController::getAuthenticatedUserId();
        $collections = $this->collectionModel->getCollectionsByUserId($user_id);
        $items = $this->itemModel->getPurchasedItemsByUserId($user_id);
        require __DIR__ . '/../views/profile/profileView.php';
    }

    public function transactionHistory()
    {
        $user_id = AuthController::getAuthenticatedUserId();
        $transactions = $this->itemModel->getTransactionHistoryByUserId($user_id);
        require __DIR__ . '/../views/profile/transactionHistoryView.php';
    }
}
