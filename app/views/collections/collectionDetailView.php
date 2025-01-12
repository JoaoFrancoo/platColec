<?php
include '../app/views/layout/header.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes da Coleção</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="container max-w-3xl p-6 bg-white shadow-lg rounded-lg">
        <h1 class="text-3xl font-bold text-center mb-6">Detalhes da Coleção</h1>
        <div class="collection-item bg-gray-50 p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold mb-4"><?php echo htmlspecialchars($collection['name']); ?></h2>
            <p class="text-gray-700 mb-4"><?php echo htmlspecialchars($collection['description']); ?></p>
            <ul class="list-disc pl-5 text-gray-700 space-y-2">
                <?php foreach($collection['details'] as $detail): ?>
                    <li><?php echo htmlspecialchars($detail); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="text-center mt-6">
            <a href="index.php" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition transform hover:scale-105">Voltar para a lista de coleções</a>
        </div>
    </div>
</body>
</html>
<?php
include '../app/views/layout/footer.php'; 
?>
