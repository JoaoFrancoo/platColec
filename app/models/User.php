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

    public function create($username, $email, $password) 
    {
        $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
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
}
