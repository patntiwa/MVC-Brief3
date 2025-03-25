<?php
class DashboardController {

    public function dashboard() {
        // Vérification d'authentification
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?route=login'); // Redirige vers login si non connecté
            exit;
        }

        // Vérification du rôle
        if (isset($_SESSION['role_name']) && $_SESSION['role_name'] == 'admin') {
            // Si l'utilisateur est un admin
            include '../app/views/admin/dashboard.php';
        } else {
            // Sinon, afficher un profil (client ou autre)
            include '../app/views/client/profile.php';
        }
    }
}
