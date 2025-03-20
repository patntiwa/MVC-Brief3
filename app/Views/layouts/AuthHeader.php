<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?= isset($pageTitle) ? $pageTitle : 'Bienvenue sur Ma Plateforme'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
<header class="bg-blue-600 text-white py-4 shadow-md">
    <div class="container mx-auto flex justify-between items-center">
        <!-- Liens dynamiques -->
        <nav>
            <?php if (isset($currentPage) && $currentPage === 'register'): ?>
                <a href="index.php?controller=auth&action=login" class="px-3 py-2 rounded hover:bg-blue-700">Connexion</a>
            <?php elseif (isset($currentPage) && $currentPage === 'login'): ?>
                <a href="index.php?controller=auth&action=showRegistrationForm" class="px-3 py-2 rounded hover:bg-blue-700">Inscription</a>
            <?php else: ?>
                <a href="index.php?controller=auth&action=login" class="px-3 py-2 rounded hover:bg-blue-700">Connexion</a>
                <a href="index.php?controller=auth&action=showRegistrationForm" class="px-3 py-2 rounded hover:bg-blue-700">Inscription</a>
            <?php endif; ?>
        </nav>
    </div>
</header>
