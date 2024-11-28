<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hasheia a senha

    $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute(['username' => $username, 'email' => $email, 'password' => $password]);
        echo "Usuário registrado com sucesso!";
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>

<form method="post" action="">
    <input type="text" name="username" placeholder="Nome de Usuário" required>
    <input type="email" name="email" placeholder="E-mail" required>
    <input type="password" name="password" placeholder="Senha" required>
    <button type="submit">Registrar</button>
</form>
