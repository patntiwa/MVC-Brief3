<?php
$pageTitle = "Tableau de bord";
include '../layouts/header.php';
?>

<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <!-- Statistiques -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-bold mb-2">Utilisateurs Total</h3>
            <p class="text-3xl font-bold text-blue-500"><?= $totalUsers ?? 0 ?></p>
        </div>
        <!-- Autres stats... -->
    </div>

    <!-- Actions rapides -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold mb-4">Actions rapides</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="index.php?controller=user&action=create" class="bg-blue-500 text-white p-4 rounded-lg text-center hover:bg-blue-600">
                Nouvel utilisateur
            </a>
            <a href="index.php?controller=user&action=index" class="bg-green-500 text-white p-4 rounded-lg text-center hover:bg-green-600">
                Gérer les utilisateurs
            </a>
            <a href="index.php?controller=user&action=logs" class="bg-purple-500 text-white p-4 rounded-lg text-center hover:bg-purple-600">
                Voir les logs
            </a>
        </div>
    </div>

    <!-- Dernières activités -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold mb-4">Dernières activités</h2>
        <table class="min-w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2">Utilisateur</th>
                    <th class="px-4 py-2">Action</th>
                    <th class="px-4 py-2">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recentActivity ?? [] as $activity): ?>
                <tr>
                    <td class="border px-4 py-2"><?= htmlspecialchars($activity['username']) ?></td>
                    <td class="border px-4 py-2"><?= htmlspecialchars($activity['action']) ?></td>
                    <td class="border px-4 py-2"><?= htmlspecialchars($activity['date']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../layouts/footer.php'; ?>
