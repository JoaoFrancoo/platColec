<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Collection</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <h1 class="text-2xl font-bold mb-4">Create New Collection</h1>
    <form action="/collections/store" method="post" class="bg-white p-6 rounded shadow-md">
        <div class="mb-4">
            <label for="user_id" class="block text-gray-700">User ID:</label>
            <input type="text" id="user_id" name="user_id" required class="w-full p-2 border border-gray-300 rounded mt-1">
        </div>

        <div class="mb-4">
            <label for="name" class="block text-gray-700">Name:</label>
            <input type="text" id="name" name="name" required class="w-full p-2 border border-gray-300 rounded mt-1">
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700">Description:</label>
            <textarea id="description" name="description" required class="w-full p-2 border border-gray-300 rounded mt-1"></textarea>
        </div>

        <div class="mb-4">
            <label for="users" class="block text-gray-700">Users:</label>
            <input type="text" id="users" name="users" required class="w-full p-2 border border-gray-300 rounded mt-1">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Create Collection</button>
    </form>
</body>
</html>
