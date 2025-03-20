<?php
$pageTitle = "Inscription";
$currentPage = "register";
//filepath: c:\wamp64\www\MVC-Brief3\app\Views\auth\register.php
// Include the header for the registration page
include_once __DIR__ . '/../layouts/AuthHeader.php';
// Include the header for the registration page
?>

<div class="max-w-md mx-auto mt-10">
    <h2 class="text-xl font-bold mb-4">Inscription</h2>
    <form action="/register" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Nom d'utilisateur</label>
            <input type="text" name="username" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
            <input type="email" name="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Mot de passe</label>
            <input type="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
                <label for="role_id" class="block text-gray-700 font-bold mb-2">Rôle</label>
                <select id="role_id" name="role_id" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="" disabled selected>Sélectionnez un rôle</option>
                    <?php foreach ($roles as $role): ?>
                        <option value="<?= htmlspecialchars($role['id']); ?>"><?= htmlspecialchars($role['name']); ?></option>
                    <?php endforeach; ?>
                </select>
        </div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            S'inscrire
        </button>
    </form>
</div>

<?php include_once __DIR__ . '/../layouts/AuthFooter.php'; ?>
