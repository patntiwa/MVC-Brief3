<?php
$pageTitle = "Liste des utilisateurs";
include __DIR__ . '/../layouts/Header.php';
?>
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold text-center mb-6">Liste des utilisateurs</h1>
    
    <!-- Bouton Ajouter -->
    <div class="mb-4">
        <a href="index.php?controller=user&action=create" 
           class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Ajouter un utilisateur
        </a>
    </div>

    <!-- Table des utilisateurs -->
    <table class="min-w-full bg-white shadow-md rounded">
        <thead>
            <tr class="bg-gray-200 text-gray-700">
                <th class="py-2 px-4 border-b">ID</th>
                <th class="py-2 px-4 border-b">Nom</th>
                <th class="py-2 px-4 border-b">Email</th>
                <th class="py-2 px-4 border-b">Rôle</th>
                <th class="py-2 px-4 border-b">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users)): ?>
                <?php foreach ($users as $user): ?>
                    <tr class="hover:bg-gray-100">
                        <td class="py-2 px-4 border-b"><?= htmlspecialchars($user['id']) ?></td>
                        <td class="py-2 px-4 border-b"><?= htmlspecialchars($user['username']) ?></td>
                        <td class="py-2 px-4 border-b"><?= htmlspecialchars($user['email']) ?></td>
                        <td class="py-2 px-4 border-b"><?= htmlspecialchars($user['role_name'] ?? 'N/A') ?></td>
                        <td class="py-2 px-4 border-b">
                            <a href="index.php?controller=user&action=edit&id=<?= $user['id'] ?>" 
                               class="text-blue-500 hover:text-blue-700 mr-2">Modifier</a>
                            <a href="index.php?controller=user&action=delete&id=<?= $user['id'] ?>" 
                               class="text-red-500 hover:text-red-700" 
                               onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
                                Supprimer
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="py-4 text-center">Aucun utilisateur trouvé</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php include __DIR__ . '/../layouts/Footer.php'; ?>