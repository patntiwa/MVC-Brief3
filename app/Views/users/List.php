<?php
$pageTitle = "Liste des utilisateurs";
include '../layouts/header.php';
?>
    <div class="container mx-auto py-8">
            <h1 class="text-2xl font-bold text-center mb-6">Liste des utilisateurs</h1>
            <table class="table-auto w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-blue-500 text-white">
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Nom d'utilisateur</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Rôle</th>
                        <th class="px-4 py-2">Statut</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr class="border-b hover:bg-gray-100">
                        <td class="px-4 py-2 text-center"><?= $user['id']; ?></td>
                        <td class="px-4 py-2"><?= htmlspecialchars($user['username']); ?></td>
                        <td class="px-4 py-2"><?= htmlspecialchars($user['email']); ?></td>
                        <td class="px-4 py-2 text-center"><?= $user['role_id']; ?></td>
                        <td class="px-4 py-2 text-center"><?= $user['status']; ?></td>
                        <td class="px-4 py-2 text-center">
                            <a href="index.php?controller=user&action=edit&id=<?= $user['id']; ?>" class="text-blue-500 hover:underline">Modifier</a>
                            <a href="index.php?controller=user&action=delete&id=<?= $user['id']; ?>" class="text-red-500 hover:underline ml-2">Supprimer</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
    </div>
<?php include '../layouts/footer.php'; ?>