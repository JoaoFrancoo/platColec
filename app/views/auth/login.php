

<div class="container">
    <h1>Login</h1>
    <?php if (isset($message)) echo "<p>$message</p>"; ?>
    <form method="post" action="">
        <input type="email" name="email" placeholder="E-mail" required>
        <input type="password" name="password" placeholder="Senha" required>
        <button type="submit">Entrar</button>
    </form>
</div>

