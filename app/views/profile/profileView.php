<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Controllers\AuthController;

$authController = new AuthController();
$user = $authController->getAuthenticatedUser();

if ($user):
?>
<?php include '../app/views/layout/header.php'; ?>
<div class="container mx-auto mt-6 px-4">
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <div class="flex items-center mb-4">
            <img src="<?php echo htmlspecialchars($user['foto']); ?>" alt="Profile Picture" class="rounded-full w-24 h-24 mr-4">
            <div>
                <h3 class="text-2xl font-bold"><?php echo htmlspecialchars($user['username']); ?></h3>
                <p class="text-gray-700"><?php echo htmlspecialchars($user['email']); ?></p>
            </div>
        </div>
        <div class="text-right">
            <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition transform hover:scale-105">Alterar Perfil</button>
        </div>
    </div>

    <div class="flex justify-center mb-6">
        <button id="collectionsBtn" class="bg-blue-500 text-white px-4 py-2 mx-2 rounded hover:bg-blue-600 transition transform hover:scale-105">Minhas Coleções</button>
        <button id="itemsBtn" class="bg-green-500 text-white px-4 py-2 mx-2 rounded hover:bg-green-600 transition transform hover:scale-105">Items Comprados</button>
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
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    document.getElementById('collectionsBtn').addEventListener('click', function() {
        document.getElementById('collectionsSection').classList.remove('hidden');
        document.getElementById('itemsSection').classList.add('hidden');
    });

    document.getElementById('itemsBtn').addEventListener('click', function() {
        document.getElementById('collectionsSection').classList.add('hidden');
        document.getElementById('itemsSection').classList.remove('hidden');
    });
</script>
<?php endif; ?>
<?php include '../app/views/layout/footer.php'; ?>
