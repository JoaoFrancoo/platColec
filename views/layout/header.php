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
        session_start(); 
        if (!isset($_SESSION['username'])) {
            header('Location: /login'); // Redireciona para a página de login se o usuário não estiver autenticado
            exit;
        }
    ?>
    <header class="bg-blue-600 text-white py-4">
        <div class="container mx-auto flex justify-between items-center px-4">
            <div class="text-lg font-bold">
                <a href="/" class="hover:text-gray-200">Colecionismo</a>
            </div>
            <nav>
                <ul class="flex space-x-4">
                    <li><a href="/" class="hover:text-gray-200">Início</a></li>
                    <li><a href="/collections" class="hover:text-gray-200">Coleções</a></li>
                    <li><a href="/market/items" class="hover:text-gray-200">Itens</a></li>
                    <li><a href="/sobre-nos" class="hover:text-gray-200">Sobre nós</a></li>
                </ul>
            </nav>
            <div>
                <?php if (isset($_SESSION['username'])): ?>
                    <span class="mr-4">Bem-vindo, <strong><a href="/profile"><?= htmlspecialchars($_SESSION['username']); ?></a></strong></span>
                    
                    <a href="/logout" class="bg-red-500 px-4 py-2 rounded text-white hover:bg-red-600">Sair</a>
                <?php else: ?>
                    <a href="/login" class="bg-green-500 px-4 py-2 rounded text-white hover:bg-green-600">Entrar</a>
                    <a href="/register" class="bg-gray-500 px-4 py-2 rounded text-white hover:bg-gray-600 ml-2">Registrar</a>
                <?php endif; ?>
            </div>
        </div>
    </header>
