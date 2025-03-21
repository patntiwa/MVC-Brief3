<?php
$pageTitle = "Mon Profil";
include '../layouts/header.php';
?>

<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Informations du profil -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h2 class="text-2xl font-bold mb-4">Mes informations</h2>
            <form action="index.php?controller=user&action=updateProfile" method="POST">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Nom d'utilisateur</label>
                        <input type="text" name="username" value="<?= htmlspecialchars($user['username'] ?? '') ?>" 
                               class="w-full px-3 py-2 border rounded-lg">
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                        <input type="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" 
                               class="w-full px-3 py-2 border rounded-lg">
                    </div>
                </div>
                <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                    Mettre à jour
                </button>
            </form>
        </div>

        <!-- Historique des connexions -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold mb-4">Historique des connexions</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Date</th>
                            <th class="px-4 py-2">IP</th>
                            <th class="px-4 py-2">Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($loginHistory ?? [] as $login): ?>
                        <tr>
                            <td class="border px-4 py-2"><?= htmlspecialchars($login['login_time']) ?></td>
                            <td class="border px-4 py-2"><?= htmlspecialchars($login['ip_address'] ?? 'N/A') ?></td>
                            <td class="border px-4 py-2">
                                <span class="px-2 py-1 rounded-full text-sm <?= $login['status'] === 'success' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                    <?= htmlspecialchars($login['status']) ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include '../layouts/footer.php'; ?>
