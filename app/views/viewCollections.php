<?php if (!empty($collections)): ?>
    <?php foreach ($collections as $collection): ?>
        <h3><?= htmlspecialchars($collection['name']); ?></h3>
        <p><?= htmlspecialchars($collection['description']); ?></p>
        <p>Criado por: <?= htmlspecialchars($collection['username']); ?></p>
        <hr>
    <?php endforeach; ?>
<?php else: ?>
    <p>Nenhuma coleção encontrada.</p>
<?php endif; ?>
