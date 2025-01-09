<?php

namespace App\Models;

use App\Config\Database;
use PDO;
use PDOException;

class CollectionModel {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function getAllCollections() {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM collections');
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao buscar todas as coleções: ' . $e->getMessage());
            return [];
        }
    }

    public function createCollection($data) {
        $query = "INSERT INTO collections (user_id, name, description) 
                  VALUES (:user_id, :name, :description)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':user_id', $data['user_id']);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->execute();
        return $this->pdo->lastInsertId();
    }

    public function associateItemsToCollection($collection_id, $items) {
        foreach ($items as $item_id) {
            $query = "INSERT INTO collection_items (collection_id, item_id) VALUES (:collection_id, :item_id)";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':collection_id', $collection_id);
            $stmt->bindParam(':item_id', $item_id);
            $stmt->execute();

            // Atualize o collection_id do item
            $this->updateItemCollection($item_id, $collection_id);
        }
    }

    public function updateItemCollection($item_id, $collection_id) {
        try {
            $query = "UPDATE items SET collection_id = :collection_id WHERE item_id = :item_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':collection_id', $collection_id);
            $stmt->bindParam(':item_id', $item_id);
            $stmt->execute();
        } catch (PDOException $e) {
            error_log('Erro ao atualizar coleção do item: ' . $e->getMessage());
            throw new \Exception('Falha ao atualizar coleção do item.');
        }
    }

    public function getCollectionById($id) {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM collections WHERE collection_id = :id');
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao buscar coleção: ' . $e->getMessage());
            return null;
        }
    }

    public function getCollectionsByUserId($userId) {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM collections WHERE user_id = :user_id');
            $stmt->execute(['user_id' => $userId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao buscar coleções por ID de usuário: ' . $e->getMessage());
            return [];
        }
    }

    public function getItemsByCollectionId($collection_id) {
        try {
            $query = "SELECT items.* FROM items
                      JOIN collection_items ON items.item_id = collection_items.item_id
                      WHERE collection_items.collection_id = :collection_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(['collection_id' => $collection_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao buscar itens por ID da coleção: ' . $e->getMessage());
            return [];
        }
    }
}
