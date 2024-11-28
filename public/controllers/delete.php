<?php
require_once '../models/db.php';

// Exclusão segura
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $table = $_POST['table']; // Nome da tabela
    $id = $_POST['id']; // ID do registro

    // Validação do nome da tabela
    $allowedTables = ['collections', 'items'];
    if (!in_array($table, $allowedTables)) {
        die("Tabela inválida.");
    }

    // Verifica se o ID foi enviado
    if (!isset($id) || !is_numeric($id)) {
        die("ID inválido.");
    }

    try {
        $sql = "DELETE FROM $table WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        header('Location: ../views/list_items.php?message=deleted'); // Redireciona após excluir
    } catch (PDOException $e) {
        die("Erro ao excluir: " . $e->getMessage());
    }
}
?>
