<?php
use App\Controllers\AuthController;

$authController = new AuthController();
$user = $authController->getAuthenticatedUser();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) : 'Site Title'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <?php 
        if (!isset($_SESSION['username'])) {
            header('Location: /profile'); 
            exit;
        }
    ?>
    <header class="bg-blue-600 text-white py-4">
        <div class="container mx-auto flex justify-between items-center px-4">
            <div class="text-lg font-bold">
                <a href="/" class="hover:text-gray-200">PlatColec</a>
            </div>
            <nav class="hidden md:flex">
                <ul class="flex space-x-4">
                    <li><a href="/" class="hover:text-gray-200">Início</a></li>
                    <li><a href="/collections" class="hover:text-gray-200">Coleções</a></li>
                    <li><a href="/market/items" class="hover:text-gray-200">Itens</a></li>
                    <li><a href="/sobre-nos" class="hover:text-gray-200">Sobre nós</a></li>
                </ul>
            </nav>
            <div class="hidden md:flex">
                <?php if (isset($_SESSION['username'])): ?>
                    <span class="mr-4">Bem-vindo, <strong><a href="/profile" class="hover:text-gray-200"><?= htmlspecialchars($_SESSION['username']); ?></a></strong></span>
                    <a href="/logout" class="bg-red-500 px-4 py-2 rounded text-white hover:bg-red-600">Sair</a>
                <?php else: ?>
                    <a href="/login" class="bg-green-500 px-4 py-2 rounded text-white hover:bg-green-600">Entrar</a>
                    <a href="/register" class="bg-gray-500 px-4 py-2 rounded text-white hover:bg-gray-600 ml-2">Registrar</a>
                <?php endif; ?>
            </div>
            <button id="menu-toggle" class="block md:hidden">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>
        <div id="menu" class="hidden md:hidden">
            <nav>
                <ul class="flex flex-col space-y-4 px-4 py-2">
                    <li><a href="/" class="hover:text-gray-200">Início</a></li>
                    <li><a href="/collections" class="hover:text-gray-200">Coleções</a></li>
                    <li><a href="/market/items" class="hover:text-gray-200">Itens</a></li>
                    <li><a href="/sobre-nos" class="hover:text-gray-200">Sobre nós</a></li>
                </ul>
            </nav>
            <div class="px-4 py-2">
                <?php if (isset($_SESSION['username'])): ?>
                    <span class="block mb-2">Bem-vindo, <strong><a href="/profile" class="hover:text-gray-200"><?= htmlspecialchars($_SESSION['username']); ?></a></strong></span>
                    <a href="/logout" class="block bg-red-500 px-4 py-2 rounded text-white hover:bg-red-600 mb-2">Sair</a>
                <?php else: ?>
                    <a href="/login" class="block bg-green-500 px-4 py-2 rounded text-white hover:bg-green-600 mb-2">Entrar</a>
                    <a href="/register" class="block bg-gray-500 px-4 py-2 rounded text-white hover:bg-gray-600">Registrar</a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <script>
        document.getElementById('menu-toggle').addEventListener('click', function() {
            var menu = document.getElementById('menu');
            menu.classList.toggle('hidden');
        });
    </script>
</body>
</html>
