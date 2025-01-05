<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Collection Detail View</title>
    <link rel="stylesheet" href="styles.css"> <!-- Adicione seu arquivo CSS aqui -->
</head>
<body>
    <div class="container">
        <h1>Detalhes da Coleção</h1>
        <div class="collection-item">
            <h2><?php echo $collection['name']; ?></h2>
            <p><?php echo $collection['description']; ?></p>
            <ul>
                <?php foreach($collection['details'] as $detail): ?>
                    <li><?php echo $detail; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <a href="index.php">Voltar para a lista de coleções</a>
    </div>
</body>
</html>
