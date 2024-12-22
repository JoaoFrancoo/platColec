<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Site de Colecionismo</title>
    <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body>
<header>
    <div class="container">
        <div class="logo">
            <a href="/">Colecionismo</a>
        </div>
        <nav>
            <ul>
                <li><a href="/">Início</a></li>
                <li><a href="/?url=collections/index">Coleções</a></li>
                <li><a href="/?url=items/index">Itens</a></li>
                <li><a href="/?url=contact">Contato</a></li>
            </ul>
        </nav>
        <div class="user-menu">
            <?php if (isset($_SESSION['user_id'])): ?>
                <span>Bem-vindo, <?= htmlspecialchars($_SESSION['username']); ?>!</span>
                <a href="/?url=auth/logout">Sair</a>
            <?php else: ?>
                <a href="/?url=auth/login">Entrar</a>
                <a href="/?url=auth/register">Registrar</a>
            <?php endif; ?>
        </div>
    </div>
</header>
