<?php
class ClientController {
    public function dashboard() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Vérifiez que l'utilisateur a les permissions nécessaires pour accéder au tableau de bord
        if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 2) {
            echo "Accès refusé.";
            exit;
        }

        // Charger la vue du tableau de bord client
        include '../app/views/client/dashboard.php';
    }
}
