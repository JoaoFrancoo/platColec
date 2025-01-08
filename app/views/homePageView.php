<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100 p-6">
    <?php 
        session_start(); 
        if (!isset($_SESSION['username'])) {
            header('Location: /login'); // Redireciona para a página de login se o usuário não estiver autenticado
            exit;
        }
    ?>
    <h1 class="text-2xl font-bold mb-4">Homepage</h1>

    <p class="text-gray-700 mb-4">Bem-vindo, <span class="font-semibold"><?php echo htmlspecialchars($_SESSION['username']); ?></span>!</p>

    <ul class="list-disc list-inside bg-white p-4 rounded shadow-md">
        <li>
            <a href="/items" class="text-blue-500 hover:underline">
                Items
            </a>
        </li>
        <li>
            <a href="/collections" class="text-blue-500 hover:underline">
                Coleções
            </a>
        </li>
    </ul>
</body>
</html>
