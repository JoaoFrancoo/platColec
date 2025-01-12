<?php include '../app/views/layout/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collection Details</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold mb-6 text-center">Collection Details</h1>
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h2 class="text-2xl font-bold mb-2"><?php echo htmlspecialchars($collection['name']); ?></h2>
            <p class="text-gray-700 mb-4"><?php echo htmlspecialchars($collection['description']); ?></p>
            <p class="text-gray-700 mb-4"><strong>Created on:</strong> <?php echo htmlspecialchars($collection['created_at']); ?></p>
        </div>

        <h2 class="text-2xl font-bold mb-6 text-center">Items in this Collection</h2>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($items as $item): ?>
                    <li class="bg-gray-50 p-4 rounded-lg shadow hover:shadow-lg transition-shadow">
                        <h3 class="text-xl font-semibold mb-2"><?php echo htmlspecialchars($item['name']); ?></h3>
                        <p class="text-gray-700 mb-2"><?php echo htmlspecialchars($item['description']); ?></p>
                        <p class="text-gray-700 mb-2"><strong>Value:</strong> <?php echo htmlspecialchars($item['value']); ?></p>
                        <div class="w-full h-32 mb-2 relative overflow-hidden rounded">
                            <img src="<?php echo htmlspecialchars('/uploads/' . $item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="absolute inset-0 w-full h-full object-cover">
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</body>
</html>
<?php include '../app/views/layout/footer.php'; ?>
