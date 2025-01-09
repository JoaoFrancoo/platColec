<?php include '../app/views/layout/header.php'; ?>
<body class="bg-gray-100 p-6">
    <h1 class="text-2xl font-bold mb-4">Collection Details</h1>
    <div class="bg-white p-6 rounded shadow-md mb-4">
        <h2 class="text-xl font-bold"><?php echo htmlspecialchars($collection['name']); ?></h2>
        <p class="text-gray-700"><?php echo htmlspecialchars($collection['description']); ?></p>
        <p class="text-gray-700"><strong>Created on:</strong> <?php echo htmlspecialchars($collection['created_at']); ?></p>
    </div>

    <h2 class="text-xl font-bold mb-4">Items in this Collection</h2>
    <div class="bg-white p-6 rounded shadow-md">
        <ul>
            <?php foreach ($items as $item): ?>
                <li class="mb-2">
                    <strong><?php echo htmlspecialchars($item['name']); ?></strong>: <?php echo htmlspecialchars($item['description']); ?><br>
                    <strong>Value:</strong> <?php echo htmlspecialchars($item['value']); ?><br>
                    <img src="<?php echo htmlspecialchars('/uploads/' . $item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="w-24 h-24 mt-2">
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
<?php include '../app/views/layout/footer.php'; ?> 
