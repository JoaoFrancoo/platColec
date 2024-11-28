<?php
require_once 'db.php';

$sql = "SELECT c.id, c.name, c.description, u.username 
        FROM collections c 
        JOIN users u ON c.user_id = u.id";
$stmt = $pdo->query($sql);

$collections = $stmt->fetchAll();

foreach ($collections as $collection) {
    echo "<h3>" . htmlspecialchars($collection['name']) . "</h3>";
    echo "<p>" . htmlspecialchars($collection['description']) . "</p>";
    echo "<p>Criado por: " . htmlspecialchars($collection['username']) . "</p>";
    echo "<hr>";
}
?>
