<?php include '../app/views/layout/header.php'; ?>
<body class="bg-gray-100 p-6">
    <main class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4 text-center">Detalhes do Item</h1>
        <div class="bg-white p-6 rounded shadow-md flex">
            <div class="w-1/3">
                <img src="<?php echo htmlspecialchars('/uploads/' . $item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="w-full h-full object-cover rounded">
            </div>
            <div class="w-2/3 pl-6">
                <h2 class="text-xl font-bold mb-2"><?php echo htmlspecialchars($item['name']); ?></h2>
                <table class="table-auto w-full">
                    <tbody>
                        <tr>
                            <td class="border px-4 py-2 font-bold">Descrição:</td>
                            <td class="border px-4 py-2"><?php echo htmlspecialchars($item['description']); ?></td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2 font-bold">Coleção:</td>
                            <td class="border px-4 py-2"><?php echo htmlspecialchars($collectionName); ?></td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2 font-bold">Valor:</td>
                            <td class="border px-4 py-2"><?php echo htmlspecialchars($item['value']) . '€'; ?></td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2 font-bold">Stock:</td>
                            <td class="border px-4 py-2"><?php echo htmlspecialchars($item['stock']); ?></td>
                        </tr>
                    </tbody>
                </table>
                <?php if ($item['stock'] == 0): ?>
                    <button class="bg-red-500 text-white px-4 py-2 rounded cursor-not-allowed mt-4" disabled>Esgotado</button>
                <?php else: ?>
                    <form action="/market/buy" method="POST" class="mt-4">
                        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($authenticated_user_id); ?>">
                        <input type="hidden" name="item_id" value="<?php echo htmlspecialchars($item['item_id']); ?>">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Comprar Item</button>
                    </form>
                <?php endif; ?>
                <a href="/market/items" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded inline-block">Voltar aos Itens</a>
            </div>
        </div>
    </main>
</body>
<?php include '../app/views/layout/footer.php'; ?>
