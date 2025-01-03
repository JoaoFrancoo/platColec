<?php 
require __DIR__ . '/../layout/header.php'; 
?>

<section class="highlights">
    <div class="container">
        <h2>Coleções em Destaque</h2>
        <div class="card-grid">
            <?php if (!empty($collections)): ?>
                <?php foreach ($collections as $collection): ?>
                    <div class="card">
                        <h3><?= htmlspecialchars($collection['name']); ?></h3>
                        <p><?= htmlspecialchars($collection['description']); ?></p>
                        <small>Criado em: <?= htmlspecialchars($collection['created_at']); ?></small>
                        <a href="/?url=collections/view&id=<?= $collection['id']; ?>" class="btn">Ver Mais</a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Nenhuma coleção disponível no momento.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../layout/footer.php'; ?>
