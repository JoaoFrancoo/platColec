

<div class="container">
    <h1>Registar</h1>
    <?php if (isset($message)) echo "<p>$message</p>"; ?>
    <form method="post" action="">
        <input type="text" name="username" placeholder="Nome de utilizador" required>
        <input type="email" name="email" placeholder="E-mail" required>
        <input type="password" name="password" placeholder="Senha" required>
        <button type="submit">Registar</button>
    </form>
</div>


