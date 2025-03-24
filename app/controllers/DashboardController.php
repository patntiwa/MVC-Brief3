<?php
class DashboardController {
    
    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?route=login');
            exit;
        }

        if ($_SESSION['role_id'] == 1) { // Rôle Admin
            include '../app/views/admin/dashboard.php';
        } else { // Rôle Client
            include '../app/views/client/profile.php';
        }
    }

    public function middleware() {
        session_start();
        if (empty($_SESSION['user'])) {
            header('Location: ?route=login'); // Redirige vers la page de connexion si non connecté
            exit;
        }
    }
    

}
