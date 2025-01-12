<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="container max-w-md p-6 bg-white shadow-lg rounded-lg">
        <h1 class="text-3xl font-bold text-center mb-6">Login</h1>
        <?php if (isset($message)) echo "<p class='text-red-500 mb-4'>$message</p>"; ?>
        <form method="post" action="" class="space-y-6">
            <div class="flex flex-col space-y-2">
                <label for="email" class="text-gray-600 font-semibold">E-mail</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    placeholder="E-mail" 
                    required 
                    class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-300"
                >
            </div>
            <div class="flex flex-col space-y-2">
                <label for="password" class="text-gray-600 font-semibold">Senha</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    placeholder="Senha" 
                    required 
                    class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-300"
                >
            </div>
            <button 
                type="submit" 
                class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition transform hover:scale-105"
            >
                Entrar
            </button>
        </form>
        <p class="mt-4 text-center text-gray-600">
            Não tem uma conta? 
            <a href="/register" class="text-blue-500 hover:underline">Registre-se aqui</a>.
        </p>
    </div>
</body>
</html>
