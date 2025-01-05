<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <h1 class="text-2xl font-bold mb-4">Items</h1>
    <a href="/items/create" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Create New Item</a>
    <ul class="space-y-4">
        <?php foreach ($items as $item): ?>
            <li class="bg-white p-6 rounded shadow-md">
                <h2 class="text-xl font-bold"><?php echo htmlspecialchars($item['name']); ?></h2>
                <p class="text-gray-700"><?php echo htmlspecialchars($item['description']); ?></p>
                <p class="text-gray-700"><strong>Collection:</strong> <?php echo htmlspecialchars($item['collection_name']); ?></p>
                <p class="text-gray-700"><strong>Value:</strong> <?php echo htmlspecialchars($item['value']); ?></p>
                <img src="<?php echo htmlspecialchars('/uploads/' . $item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="w-24 h-24 mt-2">
                <a href="/item/show/<?php echo htmlspecialchars($item['id']); ?>" class="text-blue-500 mt-2 inline-block">View Details</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
