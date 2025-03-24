<?php
// Si l'administrateur n'est pas connecté, redirigez vers la page de connexion
if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1) {
    header('Location: ?route=login');
    exit;
}

// Récupération du nom ou email de l'administrateur depuis la session
$adminName = isset($_SESSION['username']) ? $_SESSION['username'] : $_SESSION['user']['email'] ?? 'Administrateur';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex">

<!-- Sidebar -->
<div class="w-64 bg-blue-500 text-white min-h-screen px-6 py-4">
    <h2 class="text-2xl font-bold mb-6">Admin Dashboard</h2>

    <!-- Profil de l'administrateur -->
    <div class="mb-6">
        <p class="text-lg font-semibold">Bienvenue,</p>
        <p class="text-lg font-semibold"><?= htmlspecialchars($adminName); ?></p>
    </div>

    <!-- Actions principales -->
    <nav>
        <a href="?route=adminUsers" class="block py-2 px-4 rounded hover:bg-blue-600">
            Gestion des utilisateurs
        </a>
        <a href="?route=adminRoles" class="block py-2 px-4 rounded hover:bg-blue-600">
            Gestion des rôles
        </a>
        <a href="?route=adminContent" class="block py-2 px-4 rounded hover:bg-blue-600">
            Gestion des contenus
        </a>
        <a href="?route=adminSettings" class="block py-2 px-4 rounded hover:bg-blue-600">
            Paramètres administrateur
        </a>
        <a href="?route=logout" class="block py-2 px-4 rounded hover:bg-blue-600">
            Déconnexion
        </a>
    </nav>
</div>

<!-- Contenu Principal -->
<div class="flex-1 p-6">
    <h1 class="text-3xl font-semibold text-gray-800 mb-4">Tableau de bord Administrateur</h1>
    <p class="text-gray-700">
        Utilisez les options sur la gauche pour gérer les utilisateurs, les rôles, les contenus, et bien plus encore.
    </p>
</div>

</body>
</html>
