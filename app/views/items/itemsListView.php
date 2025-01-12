<?php include '../app/views/layout/header.php'; ?>
<body class="bg-gray-100 p-6">
    <h1 class="text-2xl font-bold mb-4">Items List</h1>
    
    <!-- Botão para criar novo item -->
    <div class="mb-4">
        <a href="/items/create" class="bg-green-500 text-white px-4 py-2 rounded">Create New Item</a>
    </div>
    
    <ul class="space-y-4">
        <?php foreach ($items as $item): ?>
            <li class="bg-white p-6 rounded shadow-md">
                <h2 class="text-xl font-bold"><?php echo htmlspecialchars($item['name']); ?></h2>
                <p class="text-gray-700"><?php echo htmlspecialchars($item['description']); ?></p>
                <p class="text-gray-700"><strong>Value:</strong> <?php echo htmlspecialchars($item['value']); ?></p>
                <img src="<?php echo htmlspecialchars('/uploads/' . $item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="w-24 h-24 mt-2">
                <form action="/items/buy" method="POST">
                    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($authenticated_user_id); ?>">
                    <input type="hidden" name="item_id" value="<?php echo htmlspecialchars($item['item_id']); ?>">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-2">Comprar</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
<?php include '../app/views/layout/footer.php'; ?>
