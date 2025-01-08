<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100">
    <?php 
        session_start(); 
        if (!isset($_SESSION['username'])) {
            header('Location: /login'); // Redireciona para a página de login se o usuário não estiver autenticado
            exit;
        }
    ?>

    <!-- Header -->
    <header class="bg-blue-600 text-white py-4">
        <div class="container mx-auto flex justify-between items-center px-4">
            <div class="text-lg font-bold">
                <a href="/" class="hover:text-gray-200">Colecionismo</a>
            </div>
            <nav>
                <ul class="flex space-x-4">
                    <li><a href="/" class="hover:text-gray-200">Início</a></li>
                    <li><a href="/collections" class="hover:text-gray-200">Coleções</a></li>
                    <li><a href="/items" class="hover:text-gray-200">Itens</a></li>
                    <li><a href="/contact" class="hover:text-gray-200">Contato</a></li>
                </ul>
            </nav>
            <div>
                <?php if (isset($_SESSION['username'])): ?>
                    <span class="mr-4">Bem-vindo, <strong><?= htmlspecialchars($_SESSION['username']); ?></strong></span>
                    <a href="/logout" class="bg-red-500 px-4 py-2 rounded text-white hover:bg-red-600">Sair</a>
                <?php else: ?>
                    <a href="/login" class="bg-green-500 px-4 py-2 rounded text-white hover:bg-green-600">Entrar</a>
                    <a href="/register" class="bg-gray-500 px-4 py-2 rounded text-white hover:bg-gray-600 ml-2">Registrar</a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto mt-6 px-4">
        <h1 class="text-2xl font-bold mb-4">Homepage</h1>
        <p class="text-gray-700 mb-4">Bem-vindo, <span class="font-semibold"><?php echo htmlspecialchars($_SESSION['username']); ?></span>!</p>
        <ul class="list-disc list-inside bg-white p-4 rounded shadow-md">
            <li>
                <a href="/items" class="text-blue-500 hover:underline">Itens</a>
            </li>
            <li>
                <a href="/collections" class="text-blue-500 hover:underline">Coleções</a>
            </li>
        </ul>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-4 mt-6">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Colecionismo - Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>
