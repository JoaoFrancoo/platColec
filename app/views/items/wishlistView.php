<?php include '../app/views/layout/header.php'; ?>
<body class="bg-gray-100 p-6">
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold mb-6 text-center">Lista de Desejos</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($wishlistItems as $item): ?>
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <h2 class="text-2xl font-bold mb-2"><?php echo htmlspecialchars($item['name']); ?></h2>
                    <p class="text-gray-700 mb-2"><?php echo htmlspecialchars($item['description']); ?></p>
                    <p class="text-gray-700 mb-2"><strong>Valor:</strong> <?php echo htmlspecialchars($item['value']) . '€'; ?></p>
                    <p class="text-gray-700 mb-2"><strong>Stock:</strong> <?php echo htmlspecialchars($item['stock']); ?></p>
                    <img src="<?php echo htmlspecialchars('/uploads/' . $item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="w-full h-48 object-cover rounded mb-4">
                    <a href="/items/show/<?php echo htmlspecialchars($item['item_id']); ?>" class="text-blue-500 hover:underline">Ver Detalhes</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
<?php include '../app/views/layout/footer.php'; ?>
