<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Dashboard Admin</title>
</head>
<body class="bg-gray-100 flex">

<!-- Sidebar -->
<div class="w-64 bg-blue-500 text-white min-h-screen px-6 py-4">
    <h2 class="text-2xl font-bold mb-6">Admin Dashboard</h2>
    <nav>
        <a href="?route=logout" class="block py-2 px-4 rounded hover:bg-blue-600">Déconnexion</a>
    </nav>
</div>

<!-- Contenu Principal -->
<div class="flex-1 p-6">
    <h1 class="text-3xl font-semibold text-gray-800 mb-4">Bienvenue,<?= $_SESSION['user']['email'] ?></h1>
    <p>Gérez vos utilisateurs ici, ajoutez des rôles, modifiez le contenu, etc.</p>
</div>

</body>
</html>
