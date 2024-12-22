<?php

namespace App\controllers;

use App\Config\Database;
$pdo = Database::getConnection();
use App\Models\User;
use PDOException;

class AuthController
{
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

        // Renderiza a view
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
                    header("Location: /"); // Redireciona para a página inicial
                    exit;
                } else {
                    $message = "E-mail ou senha inválidos.";
                }
            } else {
                $message = "Preencha todos os campos!";
            }
        }

        // Renderiza a view
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
