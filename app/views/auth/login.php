<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Connexion</title>
</head>
<body class="bg-gray-100">

<div class="min-h-screen flex items-center justify-center">
    <form method="POST" class="bg-white p-6 rounded shadow-md w-full max-w-sm">
        <h2 class="text-lg font-bold mb-4 text-center">Connexion</h2>

        <?php if (!empty($error)) : ?>
            <div class="bg-red-500 text-white p-2 rounded mb-4"><?= $error ?></div>
        <?php endif; ?>

        <div class="mb-4">
            <label for="email" class="block text-sm">Email</label>
            <input type="email" id="email" name="email" required
                class="w-full border rounded px-2 py-2">
        </div>

        <div class="mb-6">
            <label for="password" class="block text-sm">Mot de Passe</label>
            <input type="password" id="password" name="password" required
                class="w-full border rounded px-2 py-2">
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded shadow-md hover:bg-blue-700">Se connecter</button>
    </form>
</div>
</body>
</html>
