<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>
    <?php session_start(); ?>
    <h1>Homepage</h1>

    <?php if (isset($_SESSION['username'])): ?>
        <p>Bem-vindo, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
    <?php endif; ?>

    <ul>
        <li>
            <a href="/items">
                Items
            </a>
        </li>
        <li>
            <a href="/collections">
                Coleções
            </a>
        </li>
    </ul>

</body>
</html>
