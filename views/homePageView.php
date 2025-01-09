<?php 
$pageTitle = 'Homepage';
include 'layout/header.php'; 
?>

<!-- Main Content -->
<main class="container mx-auto mt-6 px-4">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-3xl font-bold text-center mb-6">Bem-vindo, <span class="text-blue-600"><?php echo htmlspecialchars($_SESSION['username']); ?></span>!</h1>
        <p class="text-gray-700 text-center mb-6">Explore os itens e coleções incríveis que temos a oferecer.</p>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="bg-blue-100 p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-bold text-blue-700 mb-4">Itens</h2>
                <p class="text-gray-700 mb-4">Veja todos os itens disponíveis para coleção.</p>
                <a href="/market/items" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Explorar Itens</a>
            </div>
            <div class="bg-green-100 p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-bold text-green-700 mb-4">Coleções</h2>
                <p class="text-gray-700 mb-4">Descubra as coleções criadas pelos nossos utilizadores.</p>
                <a href="/collections" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition">Ver Coleções</a>
            </div>
        </div>

        <div class="bg-gray-100 p-6 rounded-lg shadow-md text-center">
            <h2 class="text-xl font-bold mb-4">Sobre Nós</h2>
            <p class="text-gray-700 mb-4">Saiba mais sobre nossa história e missão.</p>
            <a href="/sobre-nos" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Conheça-nos Melhor</a>
        </div>
    </div>
</main>

<?php include 'layout/footer.php'; ?>
