<?php include '../app/views/layout/header.php'; ?>
<body class="bg-gray-100 p-6">
    <h1 class="text-2xl font-bold mb-4">Editar Item</h1>
    <form action="/items/update" method="post" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-md">
        <input type="hidden" name="item_id" value="<?php echo htmlspecialchars($item['item_id']); ?>">
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Nome:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($item['name']); ?>" required class="w-full p-2 border border-gray-300 rounded mt-1">
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700">Descrição:</label>
            <textarea id="description" name="description" required class="w-full p-2 border border-gray-300 rounded mt-1"><?php echo htmlspecialchars($item['description']); ?></textarea>
        </div>

        <div class="mb-4">
            <label for="value" class="block text-gray-700">Valor:</label>
            <input type="number" step="0.01" id="value" name="value" value="<?php echo htmlspecialchars($item['value']); ?>" required class="w-full p-2 border border-gray-300 rounded mt-1">
        </div>

        <div class="mb-4">
            <label for="stock" class="block text-gray-700">Stock (opcional):</label>
            <input type="number" id="stock" name="stock" value="<?php echo htmlspecialchars($item['stock']); ?>" class="w-full p-2 border border-gray-300 rounded mt-1">
        </div>

        <div class="mb-4">
            <label for="image" class="block text-gray-700">Imagem:</label>
            <input type="file" id="image" name="image" class="w-full p-2 border border-gray-300 rounded mt-1">
            <?php if (!empty($item['image_url'])): ?>
                <img src="<?php echo htmlspecialchars('/uploads/' . $item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="w-24 h-24 mt-2">
            <?php endif; ?>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Atualizar Item</button>
        <button type="button" onclick="window.location.href='/market/items'" class="bg-gray-500 text-white px-4 py-2 rounded ml-4">Cancelar</button>
    </form>
</body>
</html>
<?php include '../app/views/layout/footer.php'; ?>
