<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class User {
    private $pdo;

    public function __construct() {
        $database = Database::getInstance(); // Obtenha a instância do Database
        $this->pdo = $database->getConnection(); // E então obtenha a conexão
    }

    public function create($username, $email, $password, $foto) 
    {
        $sql = "INSERT INTO users (username, email, password, foto) VALUES (:username, :email, :password, :foto)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':foto', $foto);
        $stmt->execute();
    }

    public function findByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserById($userId)
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $userId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updatePhoto($userId, $photoPath)
    {
        $sql = "UPDATE users SET foto = :foto WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':foto', $photoPath);
        $stmt->bindParam(':id', $userId);
        $stmt->execute();
    }
}
