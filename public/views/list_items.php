<?php
require_once '../models/db.php';

// Consultar itens no banco de dados
$sql = "SELECT * FROM items WHERE collection_id = 1"; // Exemplo: Coleção fixa
$stmt = $pdo->query($sql);
$items = $stmt->fetchAll();

foreach ($items as $item) {
    echo "<div>";
    echo "<h3>" . htmlspecialchars($item['name']) . "</h3>";
    echo "<p>" . htmlspecialchars($item['description']) . "</p>";
    echo "<p>Valor: " . htmlspecialchars($item['value']) . "</p>";

    // Botão para atualizar
    echo '
    <form method="post" action="../controllers/update.php">
        <input type="hidden" name="id" value="' . $item['id'] . '">
        <input type="text" name="name" value="' . htmlspecialchars($item['name']) . '" required>
        <textarea name="description">' . htmlspecialchars($item['description']) . '</textarea>
        <input type="number" step="0.01" name="value" value="' . htmlspecialchars($item['value']) . '">
        <button type="submit">Atualizar</button>
    </form>';

    // Botão para excluir
    echo '
    <form method="post" action="../controllers/delete.php">
        <input type="hidden" name="id" value="' . $item['id'] . '">
        <button type="submit" onclick="return confirm(\'Tem certeza que deseja excluir este item?\');">Excluir</button>
    </form>';

    echo "</div><hr>";
}
?>
