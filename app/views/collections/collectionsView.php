<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collections</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <h1 class="text-2xl font-bold mb-4">Collections</h1>
    <a href="/collections/create" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Create New Collection</a>
    <ul class="space-y-4">
        <?php foreach ($collections as $collection): ?>
            <li class="bg-white p-6 rounded shadow-md">
                <h2 class="text-xl font-bold"><?php echo htmlspecialchars($collection['name']); ?></h2>
                <p class="text-gray-700"><?php echo htmlspecialchars($collection['description']); ?></p>
                <p class="text-gray-700"><strong>User ID:</strong> <?php echo htmlspecialchars($collection['user_id']); ?></p>
                <p class="text-gray-700"><strong>Users:</strong> <?php echo htmlspecialchars($collection['users']); ?></p>
                <a href="/collection/show/<?php echo htmlspecialchars($collection['id']); ?>" class="text-blue-500 mt-2 inline-block">View Details</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
