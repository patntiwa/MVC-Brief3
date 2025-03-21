<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'Gestion des utilisateurs' ?></title>
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome via CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen">
    <header class="bg-blue-600 text-white shadow-md">
        <nav class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="<?= BASE_URL ?>" class="text-xl font-bold">GestionUsers</a>
            
            <div class="flex items-center space-x-4">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <span class="hidden md:inline">
                        Bonjour, <?= htmlspecialchars($_SESSION['username']) ?>
                    </span>
                    
                    <?php if (isset($_SESSION['role_id'])): 
                        $roleModel = new Role();
                        $role = $roleModel->getById($_SESSION['role_id']);
                    ?>
                        <span class="bg-blue-700 px-2 py-1 rounded text-sm">
                            <?= htmlspecialchars($role['name'] ?? 'Utilisateur') ?>
                        </span>
                    <?php endif; ?>
                    
                    <div class="relative group">
                        <button class="flex items-center focus:outline-none">
                            <i class="fas fa-user-circle text-xl"></i>
                            <i class="fas fa-chevron-down ml-1 text-xs"></i>
                        </button>
                        
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10 invisible group-hover:visible">
                            <?php if (isset($_SESSION['role_id']) && $role['name'] === 'admin'): ?>
                                <a href="<?= BASE_URL ?>/admin/dashboard" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Tableau de bord
                                </a>
                                <a href="<?= BASE_URL ?>/admin/users" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Gérer les utilisateurs
                                </a>
                            <?php else: ?>
                                <a href="<?= BASE_URL ?>/client/dashboard" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Tableau de bord
                                </a>
                                <a href="<?= BASE_URL ?>/client/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Mon profil
                                </a>
                            <?php endif; ?>
                            
                            <hr class="my-1">
                            <a href="<?= BASE_URL ?>/logout" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                Déconnexion
                            </a>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="<?= BASE_URL ?>/login" class="px-4 py-2 bg-blue-700 rounded hover:bg-blue-800 transition">
                        Connexion
                    </a>
                    <a href="<?= BASE_URL ?>/register" class="px-4 py-2 bg-transparent border border-white rounded hover:bg-blue-700 transition">
                        Inscription
                    </a>
                <?php endif; ?>
            </div>
        </nav>
    </header>
    
    <main class="container mx-auto px-4 py-6">
        <?php if (isset($_SESSION['error'])): ?>
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded" role="alert">
                <p><?= $_SESSION['error'] ?></p>
                <?php unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['success'])): ?>
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded" role="alert">
                <p><?= $_SESSION['success'] ?></p>
                <?php unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>
