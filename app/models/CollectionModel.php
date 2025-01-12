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

    public function getAllCollections()
{
    $sql = "
        SELECT collections.*, users.username, categorias.nome AS categoria_nome
        FROM collections
        JOIN users ON collections.user_id = users.id
        LEFT JOIN categorias ON     collections.categoria_id = categorias.id
    ";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getCollectionsByCategoryId($categoryId)
{
    $sql = "
        SELECT collections.*, users.username, categorias.nome AS categoria_nome
        FROM collections
        JOIN users ON collections.user_id = users.id
        LEFT JOIN categorias ON collections.categoria_id = categorias.id
        WHERE collections.categoria_id = :categoryId
    ";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    public function getCategories()
{
    $sql = "SELECT * FROM categorias";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
    public function edit($id) {
        $collection = $this->collectionModel->getCollectionById($id);
        $categorias = $this->collectionModel->getCategories();
        require '../app/views/collections/edit.php';
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'categoria_id' => $_POST['categoria_id']
            ];

            $this->collectionModel->updateCollection($id, $data);
            header('Location: /collections/show/' . $id);
        }
    }
    public function updateCollection($id, $data) {
        try {
            $query = "UPDATE collections SET name = :name, description = :description, categoria_id = :categoria_id WHERE collection_id = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':name', $data['name']);
            $stmt->bindParam(':description', $data['description']);
            $stmt->bindParam(':categoria_id', $data['categoria_id']);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } catch (PDOException $e) {
            error_log('Erro ao atualizar coleção: ' . $e->getMessage());
            throw new \Exception('Falha ao atualizar coleção.');
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
    
    public function getItemsWithoutCollectionByUserId($user_id) {
        try {
            $query = "SELECT * FROM items WHERE user_id = :user_id AND collection_id IS NULL";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(['user_id' => $user_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao buscar itens sem coleção: ' . $e->getMessage());
            return [];
        }
    }
    
    public function addItemToCollection($collection_id, $item_id) {
        try {
            $query = "INSERT INTO collection_items (collection_id, item_id) VALUES (:collection_id, :item_id)";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':collection_id', $collection_id);
            $stmt->bindParam(':item_id', $item_id);
            $stmt->execute();
    
            $this->updateItemCollection($item_id, $collection_id);
        } catch (PDOException $e) {
            error_log('Erro ao adicionar item à coleção: ' . $e->getMessage());
            throw new \Exception('Falha ao adicionar item à coleção.');
        }
    }
    
    public function removeItemFromCollection($collection_id, $item_id) {
        try {
            $query = "DELETE FROM collection_items WHERE collection_id = :collection_id AND item_id = :item_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':collection_id', $collection_id);
            $stmt->bindParam(':item_id', $item_id);
            $stmt->execute();
    
            $this->updateItemCollection($item_id, null);
        } catch (PDOException $e) {
            error_log('Erro ao remover item da coleção: ' . $e->getMessage());
            throw new \Exception('Falha ao remover item da coleção.');
        }
    }
    public function deleteCollection($id) {
        try {
            // Log antes de atualizar collection_id dos itens para NULL
            error_log('Iniciando atualização do collection_id dos itens para NULL para a coleção: ' . $id);
    
            // Atualizar collection_id dos itens para NULL
            $query = "UPDATE items SET collection_id = NULL WHERE collection_id = :collection_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':collection_id', $id);
            $stmt->execute();
    
            // Log após atualizar collection_id dos itens para NULL
            error_log('Collection_id dos itens atualizado para NULL para a coleção: ' . $id);
    
            // Log antes de remover itens associados
            error_log('Iniciando remoção de itens associados à coleção: ' . $id);
    
            // Remover os itens associados à coleção primeiro
            $query = "DELETE FROM collection_items WHERE collection_id = :collection_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':collection_id', $id);
            $stmt->execute();
    
            // Log após remover itens associados
            error_log('Itens associados removidos com sucesso para a coleção: ' . $id);
    
            // Log antes de remover a coleção
            error_log('Iniciando remoção da coleção: ' . $id);
    
            // Agora remover a coleção
            $query = "DELETE FROM collections WHERE collection_id = :collection_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':collection_id', $id);
            $stmt->execute();
    
            // Log após remover a coleção
            error_log('Coleção removida com sucesso: ' . $id);
        } catch (PDOException $e) {
            error_log('Erro ao eliminar coleção: ' . $e->getMessage());
            throw new \Exception('Falha ao eliminar coleção.');
        }
    }    
}

