<?php include '../app/views/layout/header.php'; ?>
<body class="bg-gray-100 p-6">
    <h1 class="text-2xl font-bold mb-4">Item Details</h1>
    <div class="bg-white p-6 rounded shadow-md">
        <h2 class="text-xl font-bold"><?php echo htmlspecialchars($item['name']); ?></h2>
        <p class="text-gray-700"><?php echo htmlspecialchars($item['description']); ?></p>
        <p class="text-gray-700"><strong>Collection ID:</strong> <?php echo htmlspecialchars($item['collection_id']); ?></p>
        <p class="text-gray-700"><strong>Value:</strong> <?php echo htmlspecialchars($item['value']); ?></p>
        <img src="<?php echo htmlspecialchars('/uploads/' . $item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="w-24 h-24 mt-2">
        <a href="/items" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded inline-block">Back to Items</a>
    </div>
</body>
</html>
<?php include '../app/views/layout/header.php';  ?>
