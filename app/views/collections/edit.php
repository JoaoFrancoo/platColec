<?php include '../app/views/layout/header.php'; ?>
<body class="bg-gray-100 p-6">
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold mb-6 text-center">Editar Coleção</h1>
        <form action="/collections/update/<?php echo htmlspecialchars($collection['collection_id']); ?>" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-4">
                <label for="name" class="block text-lg font-semibold mb-2">Nome</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($collection['name']); ?>" class="w-full p-2 border border-gray-300 rounded">
            </div>
            <div class="mb-4">
                <label for="description" class="block text-lg font-semibold mb-2">Descrição</label>
                <textarea id="description" name="description" class="w-full p-2 border border-gray-300 rounded"><?php echo htmlspecialchars($collection['description']); ?></textarea>
            </div>
            <div class="mb-4">
                <label for="categoria_id" class="block text-lg font-semibold mb-2">Categoria</label>
                <select id="categoria_id" name="categoria_id" class="bg-white border border-gray-300 px-4 py-2 rounded shadow">
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?php echo htmlspecialchars($categoria['id']); ?>" <?php echo $collection['categoria_id'] == $categoria['id'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($categoria['nome']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <!-- Seção para adicionar itens -->
            <div class="mb-4">
                <h2 class="text-xl font-bold mb-2">Adicionar Itens</h2>
                <select id="add_items" name="add_items[]" class="bg-white border border-gray-300 px-4 py-2 rounded shadow" multiple>
                    <?php foreach ($itemsWithoutCollection as $item): ?>
                        <option value="<?php echo htmlspecialchars($item['item_id']); ?>">
                            <?php echo htmlspecialchars($item['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <!-- Seção para remover itens -->
            <div class="mb-4">
                <h2 class="text-xl font-bold mb-2">Remover Itens</h2>
                <select id="remove_items" name="remove_items[]" class="bg-white border border-gray-300 px-4 py-2 rounded shadow" multiple>
                    <?php foreach ($itemsInCollection as $item): ?>
                        <option value="<?php echo htmlspecialchars($item['item_id']); ?>">
                            <?php echo htmlspecialchars($item['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="text-center">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition transform hover:scale-105">Atualizar Coleção</button>
            </div>
        </form>
    </div>
</body>
<?php include '../app/views/layout/footer.php'; ?>
