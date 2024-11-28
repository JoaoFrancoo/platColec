<?php
require_once '../models/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $collection_id = $_POST['collection_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $value = $_POST['value'];

    $sql = "INSERT INTO items (collection_id, name, description, value) VALUES (:collection_id, :name, :description, :value)";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute(['collection_id' => $collection_id, 'name' => $name, 'description' => $description, 'value' => $value]);
        header('Location: ../views/list_items.php');
    } catch (PDOException $e) {
        echo "Erro ao adicionar: " . $e->getMessage();
    }
}
?>
