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
            $foto = $_FILES['foto']['name'] ?? null;

            if ($username && $email && $password && $foto) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                
                $uniqueFilename = uniqid() . '-' . basename($foto);
                $fotoPath = 'images/' . $uniqueFilename;

                if (!is_dir('images')) {
                    mkdir('images', 0777, true);
                }

                move_uploaded_file($_FILES['foto']['tmp_name'], $fotoPath);

                $userModel = new User();
                try {
                    $userModel->create($username, $email, $hashedPassword, $fotoPath);
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

    public function updateProfile()
    {
        $message = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            $userId = $_SESSION['user_id'] ?? null;
            if ($userId) {
                $foto = $_FILES['foto']['name'] ?? null;

                if ($foto) {
                    $uniqueFilename = uniqid() . '-' . basename($foto);
                    $fotoPath = 'images/' . $uniqueFilename;

                    if (!is_dir('images')) {
                        mkdir('images', 0777, true);
                    }

                    move_uploaded_file($_FILES['foto']['tmp_name'], $fotoPath);

                    $userModel = new User();
                    try {
                        $userModel->updatePhoto($userId, $fotoPath);
                        $message = "Foto atualizada com sucesso!";
                    } catch (PDOException $e) {
                        $message = "Erro ao atualizar a foto: " . $e->getMessage();
                    }
                } else {
                    $message = "Nenhuma foto foi enviada!";
                }
            } else {
                $message = "Usuário não autenticado!";
            }
        }
        $this->renderView('auth/update_profile', ['message' => $message]);
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
                    $_SESSION['foto'] = $user['foto'];
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
        header("Location: /login");
        exit;
    }

    public static function getAuthenticatedUserId()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return $_SESSION['user_id'] ?? null;
    }

    public function getAuthenticatedUser()
    {
        $userId = self::getAuthenticatedUserId();
        if ($userId) {
            $userModel = new User();
            return $userModel->getUserById($userId);
        }
        return null;
    }

    private function renderView($view, $data = [])
    {
        extract($data);
        require __DIR__ . "/../views/{$view}.php";
    }
}
