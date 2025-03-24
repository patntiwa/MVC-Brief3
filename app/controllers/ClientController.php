<?php

class ClientController {
    public function __construct() {
        session_start();
        // Vérifier si l'utilisateur est connecté et a le rôle de Client
        if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 2) {
            // Rediriger vers la page de connexion si l'utilisateur n'est pas un client
            header('Location: ?route=login');
            exit;
        }
    }

    public function dashboard() {
        // Charger la vue du tableau de bord client
        require '../app/views/client/dashboard.php';
    }
}
