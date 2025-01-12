<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class User {
    private $pdo;

    public function __construct() {
        $database = Database::getInstance(); 
        $this->pdo = $database->getConnection();
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
    public function updateProfile()
{
    $message = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        session_start();
        $userId = $_SESSION['user_id'] ?? null;
        if ($userId) {
            $username = $_POST['username'] ?? null;
            $email = $_POST['email'] ?? null;
            $foto = $_FILES['foto']['name'] ?? null;

            $data = [
                'username' => $username,
                'email' => $email
            ];

            if ($foto) {
                $uniqueFilename = uniqid() . '-' . basename($foto);
                $fotoPath = 'images/' . $uniqueFilename;

                if (!is_dir('images')) {
                    mkdir('images', 0777, true);
                }

                move_uploaded_file($_FILES['foto']['tmp_name'], $fotoPath);
                $data['foto'] = $fotoPath;
            }

            $userModel = new User();
            try {
                $userModel->updateUser($userId, $data);
                $message = "Perfil atualizado com sucesso!";
            } catch (PDOException $e) {
                $message = "Erro ao atualizar o perfil: " . $e->getMessage();
            }
        } else {
            $message = "Usuário não autenticado!";
        }
    }
    $this->renderView('auth/update_profile', ['message' => $message]);
}
    public function updateUser($user_id, $data)
    {
        $query = "UPDATE users SET username = :username, email = :email";

        if (isset($data['foto'])) {
            $query .= ", foto = :foto";
        }

        $query .= " WHERE id = :user_id";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':username', $data['username']);
        $stmt->bindParam(':email', $data['email']);

        if (isset($data['foto'])) {
            $stmt->bindParam(':foto', $data['foto']);
        }

        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
    }
}

