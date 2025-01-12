<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Controllers\AuthController;

$authController = new AuthController();
$user = $authController->getAuthenticatedUser();

if ($user):
?>
<?php include '../app/views/layout/header.php'; ?>
<div class="container mx-auto mt-6 px-4">
    <?php if (isset($message)): ?>
        <div class="bg-<?php echo strpos($message, 'Erro') === false ? 'green' : 'red'; ?>-500 text-white p-4 mb-4 rounded">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <div class="flex items-center mb-4">
            <img src="<?php echo htmlspecialchars($user['foto']); ?>" alt="Profile Picture" class="rounded-full w-24 h-24 mr-4">
            <div>
                <h3 class="text-2xl font-bold"><?php echo htmlspecialchars($user['username']); ?></h3>
                <p class="text-gray-700"><?php echo htmlspecialchars($user['email']); ?></p>
            </div>
        </div>
        <div class="text-right">
            <button id="editProfileBtn" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition transform hover:scale-105">Alterar Perfil</button>
        </div>
    </div>

    <div id="editProfileSection" class="bg-white p-6 rounded-lg shadow-md mb-6 hidden">
        <h4 class="text-2xl font-semibold mb-4">Alterar Informações do Perfil</h4>
        <form action="/profile/update" method="POST" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($user['username']); ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="foto" class="block text-sm font-medium text-gray-700">Profile Picture</label>
                <input type="file" name="foto" id="foto" class="mt-1 block w-full text-sm text-gray-500">
            </div>
            <div class="text-right">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition transform hover:scale-105">Salvar</button>
            </div>
        </form>
    </div>

    <div class="flex justify-center mb-6">
        <button id="collectionsBtn" class="bg-blue-500 text-white px-4 py-2 mx-2 rounded hover:bg-blue-600 transition transform hover:scale-105">Minhas Coleções</button>
        <button id="itemsBtn" class="bg-green-500 text-white px-4 py-2 mx-2 rounded hover:bg-green-600 transition transform hover:scale-105">Items Comprados</button>
        <button id="wishlistBtn" class="bg-yellow-500 text-white px-4 py-2 mx-2 rounded hover:bg-yellow-600 transition transform hover:scale-105">Lista de Desejos</button>
    </div>

    <div id="collectionsSection" class="bg-white p-6 rounded-lg shadow-md mb-6 hidden">
        <h4 class="text-2xl font-semibold text-blue-600 mb-4">Minhas Coleções</h4>
        <ul class="list-disc pl-5 text-gray-700 space-y-2">
            <?php foreach ($collections as $collection): ?>
                <li>
                    <strong class="text-blue-800"><?php echo htmlspecialchars($collection['name']); ?></strong>: <?php echo htmlspecialchars($collection['description']); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div id="itemsSection" class="bg-white p-6 rounded-lg shadow-md hidden">
        <h4 class="text-2xl font-semibold text-green-600 mb-4">Items Comprados</h4>
        <ul class="list-disc pl-5 text-gray-700 space-y-2">
            <?php foreach ($items as $item): ?>
                <li>
                    <strong class="text-green-800"><?php echo htmlspecialchars($item['name']); ?></strong>: <?php echo htmlspecialchars($item['description']); ?><br>
                    <span class="text-gray-600"><strong>Comprado em:</strong> <?php echo htmlspecialchars($item['purchase_date']); ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div id="wishlistSection" class="bg-white p-6 rounded-lg shadow-md hidden">
        <h4 class="text-2xl font-semibold text-yellow-600 mb-4">Lista de Desejos</h4>
        <ul class="list-disc pl-5 text-gray-700 space-y-2">
            <?php foreach ($wishlistItems as $wishlistItem): ?>
                <li>
                    <strong class="text-yellow-800"><?php echo htmlspecialchars($wishlistItem['name']); ?></strong>: <?php echo htmlspecialchars($wishlistItem['description']); ?>
                    <br>
                    <a href="/items/show/<?php echo htmlspecialchars($wishlistItem['item_id']); ?>" class="text-blue-500 hover:underline">Ver Detalhes</a>
                    <button onclick="removeFromWishlist(<?php echo htmlspecialchars($user['id']); ?>, <?php echo htmlspecialchars($wishlistItem['item_id']); ?>)" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition transform hover:scale-105 mt-2">Remover</button>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    document.getElementById('editProfileBtn').addEventListener('click', function() {
        document.getElementById('editProfileSection').classList.remove('hidden');
    });

    document.getElementById('collectionsBtn').addEventListener('click', function() {
        document.getElementById('collectionsSection').classList.remove('hidden');
        document.getElementById('itemsSection').classList.add('hidden');
        document.getElementById('wishlistSection').classList.add('hidden');
    });

    document.getElementById('itemsBtn').addEventListener('click', function() {
        document.getElementById('collectionsSection').classList.add('hidden');
        document.getElementById('itemsSection').classList.remove('hidden');
        document.getElementById('wishlistSection').classList.add('hidden');
    });

document.getElementById('wishlistBtn').addEventListener('click', function() {
    document.getElementById('collectionsSection').classList.add('hidden');
    document.getElementById('itemsSection').classList.add('hidden');
    document.getElementById('wishlistSection').classList.remove('hidden');
});

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
            location.reload(); // Recarregar a página para atualizar o estado dos itens
        } else {
            alert('Erro: ' + data.message);
        }
    })
    .catch(error => {
        alert('Erro: ' + error.message);
    });
}
</script>
<?php endif; ?>
<?php include '../app/views/layout/footer.php'; ?>
