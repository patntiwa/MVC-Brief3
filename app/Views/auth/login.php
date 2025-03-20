<!-- filepath: c:\wamp64\www\MVC-Brief3\app\Views\auth\login.php -->
<?php
$pageTitle = "Connexion";
$currentPage = "login";
include '../layouts/AuthHeader.php';
?>
    <!-- Contenu principal -->
    <main class="container mx-auto py-8">
        <h2 class="text-2xl text-center font-bold mb-4">Bienvenue sur la Page de Connexion</h2>
        <p class="text-center text-gray-700">Merci de vous connecter ou de créer un compte pour accéder à notre plateforme.</p>
    </main>
    <div class="w-full max-w-md">
        <form action="/login" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h2 class="text-2xl font-bold mb-6 text-center">Connexion</h2>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                    Email
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" name="email" placeholder="Email">
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Mot de passe
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" name="password" placeholder="Mot de passe">
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input class="mr-2 leading-tight" type="checkbox" id="remember" name="remember">
                    <label class="block text-gray-700 text-sm" for="remember">
                        Se souvenir de moi
                    </label>
                </div>
                <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="/forgot-password">
                    Mot de passe oublié ?
                </a>
            </div>
            <div class="mt-6">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full" type="submit">
                    Connexion
                </button>
            </div>
        </form>
    </div>
    <?php include_once __DIR__ . '/../layouts/AuthFooter.php'; ?>