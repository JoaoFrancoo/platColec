<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <h1 class="text-2xl font-bold mb-4">Transaction History</h1>
    
    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="py-2">Item Name</th>
                <th class="py-2">Purchase Date</th>
                <th class="py-2">Value</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transactions as $transaction): ?>
                <tr>
                    <td class="border px-4 py-2"><?php echo htmlspecialchars($transaction['name']); ?></td>
                    <td class="border px-4 py-2"><?php echo htmlspecialchars($transaction['purchase_date']); ?></td>
                    <td class="border px-4 py-2"><?php echo htmlspecialchars($transaction['value']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
