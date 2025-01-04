<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items</title>
</head>
<body>
    <h1>Items</h1>
    <ul>
        <?php foreach ($items as $item): ?>
            <li><?php echo htmlspecialchars($item['name']); ?> - <?php echo htmlspecialchars($item['description']); ?></li>
        <?php endforeach; ?>
    </ul>
    <a href="items/create">Enviar</a>
</body>
</html>
