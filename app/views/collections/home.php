<?php 

require __DIR__ . '/../layout/header.php'; ?>

<section class="highlights">
    <div class="container">
        <h2>Coleções em Destaque</h2>
        <div class="card-grid">
            <?php foreach ($collections as $collection): ?>
                <div class="card">
                    <h3><?= htmlspecialchars($collection['name']); ?></h3>
                    <p><?= htmlspecialchars($collection['description']); ?></p>
                    <small>Criado em: <?= htmlspecialchars($collection['created_at']); ?></small>
                    <a href="collection.php?id=<?= $collection['id']; ?>" class="btn">Ver Mais</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../layout/footer.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Site de Coleções</title>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="container">
                <a href="/" class="logo">Coleções</a>
                <ul class="nav-links">
                    <li><a href="/?url=auth/login">Login</a></li>
                    <li><a href="/?url=auth/register">Registrar</a></li>
                </ul>
            </div>
        </nav>
    </header>
    
    <footer>
        <div class="container">
            <p>&copy; <?= date('Y'); ?> - Site de Coleções. Todos os direitos reservados.</p>
        </div>
    </footer>
    <script src="/js/main.js"></script>
</body>
</html>
