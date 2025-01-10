<?php include '../app/views/layout/header.php'; ?>
<body class="bg-gray-100 p-6">
    <h1 class="text-2xl font-bold mb-4">Collections</h1>
    <a href="/collections/create" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Create New Collection</a>
    <ul class="space-y-4">
        <?php foreach ($collections as $collection): ?>
            <li class="bg-white p-6 rounded shadow-md">
                <h2 class="text-xl font-bold"><?php echo htmlspecialchars($collection['name']); ?></h2>
                <p class="text-gray-700"><?php echo htmlspecialchars($collection['description']); ?></p>
                <p class="text-gray-700"><strong>User ID:</strong> <?php echo htmlspecialchars($collection['user_id']); ?></p>
                <a href="/collections/show/<?php echo htmlspecialchars($collection['collection_id']); ?>" class="text-blue-500 mt-2 inline-block">View Details</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
<?php include '../app/views/layout/footer.php'; ?>