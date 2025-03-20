<?php
$pageTitle = "Modifier un utilisateur";
include '../layouts/header.php';
?>
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold text-center mb-6">Modifier un utilisateur</h1>
    <form action="index.php?controller=user&action=update" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <input type="hidden" name="id" value="<?= $user['id']; ?>">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Nom d'utilisateur</label>
            <input type="text" name="username" value="<?= htmlspecialchars($user['username']); ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
            <input type="email" name="email" value="<?= htmlspecialchars($user['email']); ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Rôle</label>
            <select name="role_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                <!-- Options de rôle -->
                <?php foreach ($roles as $role): ?>
                    <option value="<?= $role['id']; ?>" <?= $role['id'] == $user['role_id'] ? 'selected' : ''; ?>><?= htmlspecialchars($role['name']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Statut</label>
            <select name="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                <option value="active" <?= $user['status'] == 'active' ? 'selected' : ''; ?>>Actif</option>
                <option value="inactive" <?= $user['status'] == 'inactive' ? 'selected' : ''; ?>>Inactif</option>
            </select>
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Mettre à jour
            </button>
        </div>
    </form>
</div>
<?php include '../layouts/footer.php'; ?>
