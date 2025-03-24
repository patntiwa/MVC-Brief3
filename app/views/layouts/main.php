<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Utilisateurs</title>
    <!-- Intégration de Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <?php require_once 'components/header.php'; ?>
    
    <div class="flex">
        <?php require_once 'components/sidebar.php'; ?>
        
        <main class="flex-1 p-6">
            <?php echo $content ?? ''; ?>
        </main>
    </div>
    
    <?php require_once 'components/footer.php'; ?>
</body>
</html>
