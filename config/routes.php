<?php
require_once '../app/controllers/UserController.php';
require_once '../app/controllers/DashboardController.php';

$route = $_GET['route'] ?? 'login'; // Détermine la route demandée
error_log("Route demandée : " . $route); // Ajoutez cette ligne pour déboguer

session_start(); // Démarre la session

switch ($route) {
    case 'login': // Connexion
        $controller = new UserController();
        $controller->login();
        break;

    case 'logout': // Déconnexion
        $controller = new UserController();
        $controller->logout();
        break;

    case 'register': // Inscription
        $controller = new UserController();
        $controller->register();
        break;

    case 'dashboard': // Dashboard (accessible uniquement aux utilisateurs connectés)
        if (isset($_SESSION['user_id'])) {
            $controller = new DashboardController();
            $controller->dashboard();
        } else {
            header('Location: ?route=login');
            exit;
        }
        break;

    /** ===== Routes Admin : Gestion des utilisateurs ===== **/
    case 'list-users': // Lister tous les utilisateurs (admin uniquement)
        $controller = new UserController();
        $controller->listUsers();
        break;

    case 'edit-user': // Modifier un utilisateur via son ID
        if (isset($_GET['id'])) {
            $id = (int) $_GET['id']; // Récupère l'ID de l'utilisateur dans l'URL
            $controller = new UserController();
            $controller->editUser($id);
        } else {
            echo "L'ID de l'utilisateur est requis.";
        }
        break;

    case 'delete-user': // Supprimer un utilisateur (admin uniquement)
        if (isset($_GET['id'])) {
            $id = (int) $_GET['id'];
            $controller = new UserController();
            $controller->deleteUser($id);
        } else {
            echo "L'ID de l'utilisateur est requis.";
        }
        break;

    /** ===== Gestion des Erreurs ===== **/
    default:
        echo "Page introuvable.";
        break;
}
