<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Item</title>
</head>
<body>
    <h1>Create New Item</h1>
    <form action="/items/store" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea><br>

        <label for="collection_id">Collection ID:</label>
        <input type="text" id="collection_id" name="collection_id" required><br>

        <label for="value">Value:</label>
        <input type="number" step="0.01" id="value" name="value" required><br>

        <label for="image_url">Image URL:</label>
        <input type="text" id="image_url" name="image_url"><br>

        <button type="submit">Create Item</button>
    </form>
</body>
</html>
