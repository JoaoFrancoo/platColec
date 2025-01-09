<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Market Items</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <h1 class="text-2xl font-bold mb-4">Market Items</h1>

    <ul class="space-y-4">
        <?php 
        session_start();
        $authenticated_user_id = $_SESSION['user_id'];
        foreach ($items as $item): ?>
            <li class="bg-white p-6 rounded shadow-md">
                <h2 class="text-xl font-bold"><?php echo htmlspecialchars($item['name']); ?></h2>
                <p class="text-gray-700"><?php echo htmlspecialchars($item['description']); ?></p>
                <p class="text-gray-700"><strong>Value:</strong> <?php echo htmlspecialchars($item['value']); ?></p>
                <img src="<?php echo htmlspecialchars('/uploads/' . $item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="w-24 h-24 mt-2">
                <?php if ($item['user_id'] == $authenticated_user_id): ?>
                    <a href="/items/edit/<?php echo htmlspecialchars($item['item_id']); ?>" class="bg-green-500 text-white px-4 py-2 rounded mt-2">Editar Item</a>
                <?php else: ?>
                    <form action="/market/buy" method="POST">
                        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($authenticated_user_id); ?>">
                        <input type="hidden" name="item_id" value="<?php echo htmlspecialchars($item['item_id']); ?>">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-2">Comprar</button>
                    </form>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
