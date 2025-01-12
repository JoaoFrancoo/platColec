<?php include '../app/views/layout/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collections</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
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

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($collections as $collection): ?>
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
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
    </script>
</body>
</html>
<?php include '../app/views/layout/footer.php'; ?>
