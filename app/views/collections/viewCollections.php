<?php if (!empty($collections)): ?>
    <div class="container mx-auto p-4">
        <a href="/?url=collections" class="text-blue-500 underline mb-4 inline-block">&larr; Voltar para a Home</a>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            <?php foreach ($collections as $collection): ?>
                <div class="bg-white shadow-md rounded-lg p-4 border border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">
                        <?= htmlspecialchars($collection['name']); ?>
                    </h3>
                    <p class="text-gray-600 mb-4">
                        <?= htmlspecialchars($collection['description']); ?>
                    </p>
                    <p class="text-sm text-gray-500">
                        Criado por: <span class="font-medium"><?= htmlspecialchars($collection['users']); ?></span>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php else: ?>
    <div class="container mx-auto p-4">
        <a href="/?url=collections" class="text-blue-500 underline mb-4 inline-block">&larr; Voltar para a Home</a>
        <p class="text-gray-600">Nenhuma coleção encontrada.</p>
    </div>
<?php endif; ?>
