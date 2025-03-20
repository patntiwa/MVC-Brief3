<nav class="bg-gray-800">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center">
                <a href="index.php?controller=user&action=dashboard" class="text-white font-bold">
                    Tableau de bord
                </a>
                
                <div class="ml-10 flex items-baseline space-x-4">
                    <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] === 1): ?>
                        <!-- Menu Admin -->
                        <a href="index.php?controller=user&action=index" class="text-gray-300 hover:text-white px-3 py-2 rounded-md">
                            Utilisateurs
                        </a>
                        <a href="index.php?controller=user&action=roles" class="text-gray-300 hover:text-white px-3 py-2 rounded-md">
                            Rôles
                        </a>
                        <a href="index.php?controller=user&action=logs" class="text-gray-300 hover:text-white px-3 py-2 rounded-md">
                            Logs
                        </a>
                    <?php endif; ?>
                    
                    <!-- Menu Commun -->
                    <a href="index.php?controller=user&action=profile" class="text-gray-300 hover:text-white px-3 py-2 rounded-md">
                        Mon Profil
                    </a>
                </div>
            </div>
            
            <div class="flex items-center">
                <span class="text-gray-300 mr-4">
                    <?= htmlspecialchars($_SESSION['username'] ?? '') ?>
                </span>
                <a href="index.php?controller=auth&action=logout" class="text-gray-300 hover:text-white px-3 py-2 rounded-md">
                    Déconnexion
                </a>
            </div>
        </div>
    </div>
</nav>
