<?php 
$pageTitle = 'Market Items';
include '../app/views/layout/header.php'; 
?>

<!-- Main Content -->
<main class="container mx-auto mt-6 px-4">
    <h1 class="text-2xl font-bold mb-4">Market Items</h1>
    <div class="mb-4">
        <a href="/items/create" class="bg-green-500 text-white px-4 py-2 rounded">Create New Item</a>
    </div>
    <ul class="space-y-4">
        <?php 
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
</main>

<?php include '../app/views/layout/footer.php'; ?>
