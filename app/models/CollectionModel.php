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
            error_log('Erro ao buscar coleções: ' . $e->getMessage());
            return [];
        }
    }

    public function getCollectionById($id) {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM collections WHERE id = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao buscar coleção por ID: ' . $e->getMessage());
            return null;
        }
    }

    public function createCollection($data) {
        try {
            $stmt = $this->pdo->prepare('INSERT INTO collections (user_id, name, description, users) VALUES (:user_id, :name, :description, :users)');
            $stmt->bindParam(':user_id', $data['user_id'], PDO::PARAM_INT);
            $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
            $stmt->bindParam(':description', $data['description'], PDO::PARAM_STR);
            $stmt->bindParam(':users', $data['users'], PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            error_log('Erro ao criar coleção: ' . $e->getMessage());
            throw new \Exception('Falha ao criar coleção. Tente novamente.');
        }
    }
}
