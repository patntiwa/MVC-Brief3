<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Dashboard</title>
</head>
<body class="bg-gray-100 flex">
    <div class="w-64 bg-blue-600 text-white h-screen p-4">
        <h2 class="text-2xl font-bold">Dashboard</h2>
        <a href="?route=logout" class="block py-2 rounded bg-blue-700 mt-4 text-center">Déconnexion</a>
    </div>
    <div class="flex-1 p-6">
        <h1 class="text-2xl font-bold">Bienvenue, <?= $_SESSION['user']['email'] ?></h1>
    </div>
</body>
</html>
