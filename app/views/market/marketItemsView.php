<?php 
$pageTitle = 'Market Items';
include '../app/views/layout/header.php'; 
?>

<main class="container mx-auto mt-6 px-4">
    <h1 class="text-2xl font-bold mb-4 text-center">Market Items</h1>
    <div class="mb-4 text-center">
        <a href="/items/create" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition transform hover:scale-105">Create New Item</a>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php 
        $authenticated_user_id = $_SESSION['user_id'];
        foreach ($items as $item): 
            $isInWishlist = $this->itemModel->isInWishlist($authenticated_user_id, $item['item_id']);
        ?>
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                <h2 class="text-xl font-bold mb-2"><?php echo htmlspecialchars($item['name']); ?></h2>
                <p class="text-gray-700 mb-2"><?php echo htmlspecialchars($item['description']); ?></p>
                <p class="text-gray-700 mb-2"><strong>Valor:</strong> <?php echo htmlspecialchars($item['value']) . '€'; ?></p>
                <p class="text-gray-700 mb-2"><strong>Stock:</strong> <?php echo htmlspecialchars($item['stock']); ?></p>
                <img src="<?php echo htmlspecialchars('/uploads/' . $item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="w-full h-48 object-cover rounded mb-4">
                <?php if ($item['user_id'] == $authenticated_user_id): ?>
                    <a href="/items/edit/<?php echo htmlspecialchars($item['item_id']); ?>" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition transform hover:scale-105">Editar Item</a>
                <?php else: ?>
                    <?php if ($item['stock'] == 0): ?>
                        <button class="bg-red-500 text-white px-4 py-2 rounded cursor-not-allowed" disabled>Esgotado</button>
                    <?php else: ?>
                        <form action="/market/buy" method="POST">
                            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($authenticated_user_id); ?>">
                            <input type="hidden" name="item_id" value="<?php echo htmlspecialchars($item['item_id']); ?>">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition transform hover:scale-105">Comprar</button>
                        </form>
                        <?php if ($isInWishlist): ?>
                            <button onclick="removeFromWishlist(<?php echo htmlspecialchars($authenticated_user_id); ?>, <?php echo htmlspecialchars($item['item_id']); ?>)" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition transform hover:scale-105 mt-2">Remover da Lista de Desejos</button>
                        <?php else: ?>
                            <button onclick="addToWishlist(<?php echo htmlspecialchars($authenticated_user_id); ?>, <?php echo htmlspecialchars($item['item_id']); ?>)" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition transform hover:scale-105 mt-2">Adicionar à Lista de Desejos</button>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>
                <!-- Botão "Mais detalhes" -->
                <a href="/items/show/<?php echo htmlspecialchars($item['item_id']); ?>" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition transform hover:scale-105 mt-2 inline-block">Mais detalhes</a>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<script>
    function addToWishlist(userId, itemId) {
        const formData = new FormData();
        formData.append('user_id', userId);
        formData.append('item_id', itemId);

        fetch('/add_to_wishlist', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert(data.message);
                location.reload(); 
            } else {
                alert('Erro: ' + data.message);
            }
        })
        .catch(error => {
            alert('Erro: ' + error.message);
        });
    }

    function removeFromWishlist(userId, itemId) {
        const formData = new FormData();
        formData.append('user_id', userId);
        formData.append('item_id', itemId);

        fetch('/remove_from_wishlist', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert(data.message);
                location.reload();
            } else {
                alert('Erro: ' + data.message);
            }
        })
        .catch(error => {
            alert('Erro: ' + error.message);
        });
    }
</script>

<?php include '../app/views/layout/footer.php'; ?>
