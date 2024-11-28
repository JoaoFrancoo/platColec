<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $collection_id = $_POST['collection_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $value = $_POST['value'];

    $sql = "INSERT INTO items (collection_id, name, description, value) VALUES (:collection_id, :name, :description, :value)";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute(['collection_id' => $collection_id, 'name' => $name, 'description' => $description, 'value' => $value]);
        echo "Item adicionado com sucesso!";
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>

<form method="post" action="">
    <input type="hidden" name="collection_id" value="1"> <!-- Exemplo: Coleção fixa -->
    <input type="text" name="name" placeholder="Nome do Item" required>
    <textarea name="description" placeholder="Descrição"></textarea>
    <input type="number" step="0.01" name="value" placeholder="Valor">
    <button type="submit">Adicionar Item</button>
</form>
