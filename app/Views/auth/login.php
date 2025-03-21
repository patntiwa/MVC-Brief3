<?php require_once ROOT_PATH . '/app/views/layouts/header.php'; ?>

<div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-md mt-10">
    <div class="md:flex">
        <div class="w-full p-6">
            <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Connexion</h1>
            
            <form action="<?= BASE_URL ?>/login" method="POST" class="space-y-4">
                <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
                
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-1">
                        Nom d'utilisateur
                    </label>
                    <input type="text" id="username" name="username" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
                
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                        Mot de passe
                    </label>
                    <input type="password" id="password" name="password" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
                
                <div class="flex items-center">
                    <input type="checkbox" id="remember" name="remember" 
                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="remember" class="ml-2 block text-sm text-gray-700">
                        Se souvenir de moi
                    </label>
                </div>
                
                <div>
                    <button type="submit" 
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Se connecter
                    </button>
                </div>
            </form>
            
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Vous n'avez pas de compte ? 
                    <a href="<?= BASE_URL ?>/register" class="font-medium text-blue-600 hover:text-blue-500">
                        Inscrivez-vous
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

<?php require_once ROOT_PATH . '/app/views/layouts/footer.php'; ?>
