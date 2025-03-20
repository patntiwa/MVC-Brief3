<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? $pageTitle : 'Mon Application'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <header class="bg-blue-600 text-white py-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold"><?= isset($pageTitle) ? $pageTitle : 'Bienvenue'; ?></h1>
            <nav>
                <a href="index.php" class="px-3 py-2 rounded hover:bg-blue-700">Accueil</a>
                <a href="index.php?controller=user&action=index" class="px-3 py-2 rounded hover:bg-blue-700">Utilisateurs</a>
                <a href="index.php?controller=user&action=create" class="px-3 py-2 rounded hover:bg-blue-700">Ajouter</a>
            </nav>
        </div>
    </header>
