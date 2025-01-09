<?php include '../app/views/layout/header.php'; ?>
<body class="bg-gray-100 p-6">
    <h1 class="text-2xl font-bold mb-4">My Profile</h1>

    <h2 class="text-xl font-bold mb-4">My Collections</h2>
    <div class="bg-white p-6 rounded shadow-md mb-4">
        <ul>
            <?php foreach ($collections as $collection): ?>
                <li class="mb-2">
                    <strong><?php echo htmlspecialchars($collection['name']); ?></strong>: <?php echo htmlspecialchars($collection['description']); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <h2 class="text-xl font-bold mb-4">My Purchased Items</h2>
    <div class="bg-white p-6 rounded shadow-md">
        <ul>
            <?php foreach ($items as $item): ?>
                <li class="mb-2">
                    <strong><?php echo htmlspecialchars($item['name']); ?></strong>: <?php echo htmlspecialchars($item['description']); ?><br>
                    <strong>Purchased on:</strong> <?php echo htmlspecialchars($item['purchase_date']); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
<?php include '../app/views/layout/footer.php'; ?>
