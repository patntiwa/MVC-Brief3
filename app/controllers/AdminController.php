<?php

class AdminController {
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1) {
            // Rediriger si ce n'est pas un administrateur (rôle_id = 1)
            header('Location: ?route=login');
            exit;
        }
    }

    public function dashboard() {
        // Afficher le tableau de bord administrateur
        require '../app/views/admin/dashboard.php';
    }
}
