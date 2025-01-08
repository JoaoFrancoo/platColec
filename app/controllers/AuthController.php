<?php

namespace App\Controllers;

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/User.php';

use App\Config\Database;
use App\Models\User;
use PDOException;

class AuthController
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function register()
    {
        $message = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? null;
            $email = $_POST['email'] ?? null;
            $password = $_POST['password'] ?? null;

            if ($username && $email && $password) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $userModel = new User();
                try {
                    $userModel->create($username, $email, $hashedPassword);
                    $message = "Usuário registrado com sucesso!";
                } catch (PDOException $e) {
                    $message = "Erro ao registrar: " . $e->getMessage();
                }
            } else {
                $message = "Preencha todos os campos!";
            }
        }
        $this->renderView('auth/register', ['message' => $message]);
    }

    public function login()
    {
        $message = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? null;
            $password = $_POST['password'] ?? null;

            if ($email && $password) {
                $userModel = new User();
                $user = $userModel->findByEmail($email);

                if ($user && password_verify($password, $user['password'])) {
                    session_start();
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    header("Location: /");
                    exit;
                } else {
                    $message = "E-mail ou senha inválidos.";
                }
            } else {
                $message = "Preencha todos os campos!";
            }
        }
        $this->renderView('auth/login', ['message' => $message]);
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header("Location: /");
        exit;
    }

    private function renderView($view, $data = [])
    {
        extract($data);
        require __DIR__ . "/../views/{$view}.php";
    }
}
