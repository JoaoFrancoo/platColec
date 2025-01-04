<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collections</title>
</head>
<body>
    <h1>Collections</h1>
    <ul>
        <?php foreach ($colecoes as $colecao): ?>
            <li><?php echo htmlspecialchars($colecao['name']); ?> - <?php echo htmlspecialchars($colecao['description']); ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
