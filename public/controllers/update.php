<?php
require_once '../models/db.php';

// Atualização segura
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
        if ($table === 'collections') {
            $name = $_POST['name'];
            $description = $_POST['description'];

            $sql = "UPDATE collections SET name = :name, description = :description WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['name' => $name, 'description' => $description, 'id' => $id]);

        } elseif ($table === 'items') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $value = $_POST['value'];

            $sql = "UPDATE items SET name = :name, description = :description, value = :value WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['name' => $name, 'description' => $description, 'value' => $value, 'id' => $id]);
        }

        header('Location: ../views/list_items.php?message=updated'); // Redireciona após atualizar
    } catch (PDOException $e) {
        die("Erro ao atualizar: " . $e->getMessage());
    }
}
?>
