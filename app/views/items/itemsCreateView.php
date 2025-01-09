<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Item</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <h1 class="text-2xl font-bold mb-4">Create New Item</h1>
    <form action="/items/store" method="post" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-md">
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Name:</label>
            <input type="text" id="name" name="name" required class="w-full p-2 border border-gray-300 rounded mt-1">
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700">Description:</label>
            <textarea id="description" name="description" required class="w-full p-2 border border-gray-300 rounded mt-1"></textarea>
        </div>

        <div class="mb-4">
            <label for="value" class="block text-gray-700">Value:</label>
            <input type="number" step="0.01" id="value" name="value" required class="w-full p-2 border border-gray-300 rounded mt-1">
        </div>

        <div class="mb-4">
            <label for="stock" class="block text-gray-700">Stock (optional):</label>
            <input type="number" id="stock" name="stock" class="w-full p-2 border border-gray-300 rounded mt-1">
        </div>

        <div class="mb-4">
            <label for="image" class="block text-gray-700">Image:</label>
            <input type="file" id="image" name="image" required class="w-full p-2 border border-gray-300 rounded mt-1">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Create Item</button>
    </form>
</body>
</html>
