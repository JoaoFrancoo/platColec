<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class CollectionModel {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function getAllCollections() {
        $stmt = $this->pdo->prepare('SELECT * FROM collections');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCollectionById($id) {
        $stmt = $this->pdo->prepare('SELECT * FROM collections WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createCollection($data) {
        $stmt = $this->pdo->prepare('INSERT INTO collections (user_id, name, description, users) VALUES (:user_id, :name, :description, :users)');
        $stmt->bindParam(':user_id', $data['user_id']);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':users', $data['users']);
        $stmt->execute();
    }
}
