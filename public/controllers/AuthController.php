<?php

require_once '/models/User.php';

class AuthController {
    public function register() {
        // Verifica se o formulário foi enviado
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hasheia a senha

            // Usa o modelo para salvar o usuário
            $userModel = new User();
            try {
                $userModel->create($username, $email, $password);
                $message = "Usuário registrado com sucesso!";
            } catch (PDOException $e) {
                $message = "Erro ao registrar: " . $e->getMessage();
            }
        }

        // Renderiza a view 
        require_once '/views/auth/register.php';
    }
}
class AuthController {
    public function login() {
        session_start(); // Inicia a sessão

        // Processa o formulário
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Usa o modelo para validar o login
            $userModel = new User();
            $user = $userModel->findByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                // Login bem-sucedido
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $message = "Login bem-sucedido! Bem-vindo, " . $user['username'];
            } else {
                // Falha no login
                $message = "E-mail ou senha inválidos.";
            }
        }

        // Renderiza a view de login
        require_once '/views/auth/login.php';
    }
}
