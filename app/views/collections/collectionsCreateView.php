<?php
include '../app/views/layout/header.php'; 
?>
<body class="bg-gray-100 p-6">
    <h1 class="text-2xl font-bold mb-4">Create New Collection</h1>
    <form action="/collections/store" method="post" class="bg-white p-6 rounded shadow-md">
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Name:</label>
            <input type="text" id="name" name="name" required class="w-full p-2 border border-gray-300 rounded mt-1">
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700">Description:</label>
            <textarea id="description" name="description" required class="w-full p-2 border border-gray-300 rounded mt-1"></textarea>
        </div>

        <div class="mb-4">
            <label for="items" class="block text-gray-700">Select Items:</label>
            <select id="items" name="items[]" multiple class="w-full p-2 border border-gray-300 rounded mt-1">
                <?php foreach ($items as $item): ?>
                    <option value="<?php echo htmlspecialchars($item['item_id']); ?>"><?php echo htmlspecialchars($item['name']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Create Collection</button>
    </form>
</body>
</html>
<?php include '../app/views/layout/footer.php'; ?>
