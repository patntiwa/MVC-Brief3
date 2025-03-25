<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Inscription</title>
</head>
<body class="bg-gray-100">

<div class="flex items-center justify-center h-screen">
    <form action="?route=register" method="POST" class="bg-white p-6 rounded shadow-md w-full max-w-sm">
        <h2 class="text-lg font-bold mb-4 text-center">Créer un compte</h2>

        <?php if (!empty($error)): ?>
            <div class="bg-red-500 text-white p-2 rounded mb-4"><?= $error ?></div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="bg-green-500 text-white p-2 rounded mb-4"><?= $success ?></div>
        <?php endif; ?>

        <div class="mb-4">
            <label for="username" class="block text-sm">Nom d'utilisateur</label>
            <input type="text" id="username" name="username" required 
                class="w-full border rounded px-2 py-2">
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm">Adresse e-mail</label>
            <input type="email" id="email" name="email" required 
                class="w-full border rounded px-2 py-2">
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm">Mot de passe</label>
            <input type="password" id="password" name="password" required 
                class="w-full border rounded px-2 py-2">
        </div>

        <div class="mb-4">
            <label for="confirm_password" class="block text-sm">Confirmer le mot de passe</label>
            <input type="password" id="confirm_password" name="confirm_password" required 
                class="w-full border rounded px-2 py-2">
        </div>

        <div class="mb-6">
            <label for="role_id" class="block text-sm">Rôle</label>
            <select id="role_id" name="role_id" required class="w-full border rounded px-2 py-2">
                <option value="" disabled selected>Choisissez un rôle</option>
                <?php foreach ($roles as $role): ?>
                    <option value="<?= htmlspecialchars($role['name']); ?>">
                        <?= htmlspecialchars(ucfirst($role['name'])); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded shadow-md hover:bg-blue-700">
            S'inscrire
        </button>

        <p class="text-center text-sm mt-4">
            Déjà un compte ? <a href="?route=loginPage" class="text-blue-600 underline">Connectez-vous</a>
        </p>
    </form>
</div>

</body>
</html>
