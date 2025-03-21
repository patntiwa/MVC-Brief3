<?php require_once ROOT_PATH . '/app/views/layouts/header.php'; ?>

<div class="bg-white shadow rounded-lg p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Tableau de bord client</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded shadow">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-blue-100 rounded-full p-3">
                    <i class="fas fa-user text-blue-500 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-blue-800">Bienvenue</p>
                    <p class="text-xl font-bold text-blue-600"><?= htmlspecialchars($user['username']) ?></p>
                </div>
            </div>
        </div>
        
        <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded shadow">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-green-100 rounded-full p-3">
                    <i class="fas fa-calendar-alt text-green-500 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-green-800">Membre depuis</p>
                    <p class="text-xl font-bold text-green-600">
                        <?= (new DateTime($user['created_at']))->format('d/m/Y') ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <div>
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Historique de vos connexions</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Date de connexion
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Date de déconnexion
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Durée
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($sessions as $session): ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                <?= htmlspecialchars($session['login_time']) ?>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                <?= $session['logout_time'] ? htmlspecialchars($session['logout_time']) : '<span class="text-green-600">Session active</span>' ?>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500">
                                <?php
                                if ($session['logout_time']) {
                                    $login = new DateTime($session['login_time']);
                                    $logout = new DateTime($session['logout_time']);
                                    $diff = $login->diff($logout);
                                    echo $diff->format('%H:%I:%S');
                                } else {
                                    echo '<span class="text-green-600">En cours</span>';
                                }
                                ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once ROOT_PATH . '/app/views/layouts/footer.php'; ?>
