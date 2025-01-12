<?php

namespace App\Models;

use App\Config\Database;
use PDO;
use PDOException;

class ItemModel {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function getAllItems() {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM items');
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao buscar todos os itens: ' . $e->getMessage());
            return [];
        }
    }

    public function getItemsWithoutCollection() {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM items WHERE collection_id IS NULL');
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao buscar itens sem coleção: ' . $e->getMessage());
            return [];
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

    public function getItemById($item_id) {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM items WHERE item_id = :item_id');
            $stmt->execute(['item_id' => $item_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao buscar item: ' . $e->getMessage());
            return null;
        }
    }

    public function createItem($data) {
        $stock = isset($data['stock']) ? $data['stock'] : 1; // Definir estoque padrão como 1

        $query = "INSERT INTO items (name, description, collection_id, user_id, value, image_url, stock) 
                  VALUES (:name, :description, :collection_id, :user_id, :value, :image_url, :stock)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':collection_id', $data['collection_id'], PDO::PARAM_INT | PDO::PARAM_NULL); // Permitir null
        $stmt->bindParam(':user_id', $data['user_id']);
        $stmt->bindParam(':value', $data['value']);
        $stmt->bindParam(':image_url', $data['image_url']);
        $stmt->bindParam(':stock', $stock);
        $stmt->execute();
    }

    public function updateItem($item_id, $data) {
        try {
            $query = "UPDATE items SET 
                      name = :name, 
                      description = :description, 
                      value = :value, 
                      stock = :stock";
            
            if (isset($data['image_url'])) {
                $query .= ", image_url = :image_url";
            }

            $query .= " WHERE item_id = :item_id";

            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':name', $data['name']);
            $stmt->bindParam(':description', $data['description']);
            $stmt->bindParam(':value', $data['value']);
            $stmt->bindParam(':stock', $data['stock']);
            if (isset($data['image_url'])) {
                $stmt->bindParam(':image_url', $data['image_url']);
            }
            $stmt->bindParam(':item_id', $item_id);
            $stmt->execute();
        } catch (PDOException $e) {
            error_log('Erro ao atualizar item: ' . $e->getMessage());
            throw new \Exception('Falha ao atualizar item. Tente novamente.');
        }
    }

    public function getItemsByUserId($userId) {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM items WHERE user_id = :user_id');
            $stmt->execute(['user_id' => $userId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao buscar itens por ID de usuário: ' . $e->getMessage());
            return [];
        }
    }

    public function getPurchasedItemsByUserId($userId) {
        $query = "
            SELECT items.*, user_items.purchase_date 
            FROM items 
            JOIN user_items ON items.item_id = user_items.item_id 
            WHERE user_items.user_id = :user_id
        ";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['user_id' => $userId]);
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $items;
    }

    public function getTransactionHistoryByUserId($userId) {
        $query = "
            SELECT items.name, user_items.purchase_date, items.value 
            FROM items 
            JOIN user_items ON items.item_id = user_items.item_id 
            WHERE user_items.user_id = :user_id
            ORDER BY user_items.purchase_date DESC
        ";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buyItem($userId, $itemId) {
        // Verifica o estoque
        $stmt = $this->pdo->prepare('SELECT stock FROM items WHERE item_id = ?');
        $stmt->execute([$itemId]);
        $item = $stmt->fetch();

        // Verifique se o item existe e se há estoque
        if ($item === false) {
            throw new \Exception('Item não encontrado.');
        }

        if ($item['stock'] <= 0) {
            throw new \Exception('Item sem estoque.');
        }

        $stmt = $this->pdo->prepare('UPDATE items SET stock = stock - 1 WHERE item_id = ?');
        $stmt->execute([$itemId]);

        $stmt = $this->pdo->prepare('INSERT INTO user_items (user_id, item_id, purchase_date) VALUES (?, ?, NOW())');
        return $stmt->execute([$userId, $itemId]);
    }
    
    public function getCollectionNameById($collection_id)
    {
        $stmt = $this->pdo->prepare('SELECT name FROM collections WHERE collection_id = :collection_id');
        $stmt->bindParam(':collection_id', $collection_id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['name'] : null;
    }


}
