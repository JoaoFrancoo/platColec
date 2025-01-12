<?php include '../app/views/layout/header.php'; ?>
<body class="bg-gray-100 p-6">
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold mb-6 text-center">Collections</h1>
        <div class="text-center mb-6">
            <a href="/collections/create" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition transform hover:scale-105 inline-block">Create New Collection</a>
        </div>
        <!-- Dropdown para Seleção de Categorias -->
        <div class="text-center mb-6">
            <label for="categoria" class="block text-lg font-semibold mb-2">Selecione uma Categoria</label>
            <select id="categoria" name="categoria" class="bg-white border border-gray-300 px-4 py-2 rounded shadow">
                <option value="">Todas as Categorias</option>
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?php echo htmlspecialchars($categoria['id']); ?>" <?php echo isset($_GET['categoria_id']) && $_GET['categoria_id'] == $categoria['id'] ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($categoria['nome']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-6">
            <input type="text" id="search" placeholder="Pesquisar..." class="w-full p-2 border border-gray-300 rounded">
        </div>
        <div id="collection-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($collections as $collection): ?>
                <div class="collection-item bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <h2 class="text-2xl font-bold mb-2"><?php echo htmlspecialchars($collection['name']); ?></h2>
                    <p class="text-gray-700 mb-2"><?php echo htmlspecialchars($collection['description']); ?></p>
                    <p class="text-gray-700 mb-2"><strong>Created by:</strong> <?php echo htmlspecialchars($collection['username']); ?></p>
                    <p class="text-gray-700 mb-2"><strong>Category:</strong> <?php echo htmlspecialchars($collection['categoria_nome']); ?></p>
                    <a href="/collections/show/<?php echo htmlspecialchars($collection['collection_id']); ?>" class="text-blue-500 mt-2 inline-block hover:underline">View Details</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        document.getElementById('categoria').addEventListener('change', function() {
            var categoriaId = this.value;
            if (categoriaId) {
                window.location.href = '/collections?categoria_id=' + categoriaId;
            } else {
                window.location.href = '/collections';
            }
        });

        // Função para filtro de pesquisa
        document.getElementById('search').addEventListener('input', function() {
            var searchValue = this.value.toLowerCase();
            var collections = document.querySelectorAll('.collection-item');

            collections.forEach(function(collection) {
                var collectionName = collection.querySelector('h2').textContent.toLowerCase();
                if (collectionName.includes(searchValue)) {
                    collection.style.display = 'block';
                } else {
                    collection.style.display = 'none';
                }
            });
        });
    </script>
</body>
<?php include '../app/views/layout/footer.php'; ?>
