<div class="container mx-auto max-w-md p-6 bg-white shadow-md rounded">
    <h1 class="text-2xl font-bold mb-4">Login</h1>
    <?php if (isset($message)) echo "<p class='text-red-500 mb-4'>$message</p>"; ?>
    <form method="post" action="" class="space-y-4">
        <input 
            type="email" 
            name="email" 
            placeholder="E-mail" 
            required 
            class="w-full px-4 py-2 border rounded focus:outline-none focus:ring focus:ring-blue-300"
        >
        <input 
            type="password" 
            name="password" 
            placeholder="Senha" 
            required 
            class="w-full px-4 py-2 border rounded focus:outline-none focus:ring focus:ring-blue-300"
        >
        <button 
            type="submit" 
            class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition"
        >
            Entrar
        </button>
    </form>
    <p class="mt-4 text-center">
        Não tem uma conta? 
        <a href="/register" class="text-blue-500 hover:underline">Registre-se aqui</a>.
    </p>
</div>
