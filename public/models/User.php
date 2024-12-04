<?php

class User {
    private $pdo;

    public function __construct() {
        $this->pdo = require 'public/models/db.php'; // Conexão com o banco de dados
    }

    public function create($username, $email, $password) {
        $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'username' => $username,
            'email' => $email,
            'password' => $password,
        ]);
    }
}
