<h1>Liste des Rôles</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom du rôle</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($roles as $role): ?>
            <tr>
                <td><?= htmlspecialchars($role['id']); ?></td>
                <td><?= htmlspecialchars(ucfirst($role['name'])); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
